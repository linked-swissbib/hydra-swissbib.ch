<?php

namespace LinkedSwissbibBundle\Elasticsearch;

use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Ring\Client\ClientUtils;
use Monolog\Logger;
use \LinkedSwissbibBundle\ContextMapping\ContextMapper;

class ElasticsearchContextMapper implements ContextMapper
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache, Client $client, array $config)
    {
        $this->cache = $cache;
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function fromInternalToExternal(string $type, array $internal) : array
    {
        $cacheKey = 'elasticsearch_context_mapper.from_internal_to_external.' . $type;
        $mappedValues = [];

        if ($this->cache->contains($cacheKey)) {
            $mapping = $this->cache->fetch($cacheKey);
        } else {
            $remoteContext = $this->loadRemoteContext($type);
            $mapping = [];

            foreach ($remoteContext['@context'] as $propertyName => $propertyValue) {
                if (strpos($propertyName, ':') !== false) {
                    list($namespace, $value) = explode(':', $propertyName);

                    $mapping[$value] = $propertyName;
                }
            }

            $this->cache->save($cacheKey, $mapping);
        }

        foreach ($internal as $property) {
            $mappedValues[] = $mapping[$property] ?? $property;
        }

        return $mappedValues;
    }

    /**
     * {@inheritdoc}
     */
    public function fromExternalToInternal(string $type, array $external) : array
    {
        $data = [];

        foreach ($external['hits']['hits'] as $hits) {
            $entity = [];

            foreach ($hits['_source'] as $propertyKey => $propertyValue) {
                if (strpos($propertyKey, ':') !== false) {
                    list($namespace, $value) = explode(':', $propertyKey);

                    $entity[$value] = $hits['_source'][$propertyKey];
                }
            }

            $entity['id'] = $hits['_id'];
            $data[] = $entity;
        }

        return count($data) === 1 ? $data[0] : $data;
    }

    /**
     * @param string $type
     *
     * @return array
     *
     * @throws \Exception
     */
    protected function loadRemoteContext(string $type)
    {
        $url = str_replace('{type}', $type, $this->config['template_url']);

        $response = $this->client->get($url);
        $body = $response->getBody();

        return json_decode($body, true);
    }
}
