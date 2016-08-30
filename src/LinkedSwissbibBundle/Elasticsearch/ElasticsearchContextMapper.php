<?php

namespace LinkedSwissbibBundle\Elasticsearch;

use Doctrine\Common\Cache\Cache;
use Monolog\Logger;
use \LinkedSwissbibBundle\ContextMapping\ContextMapper;

class ElasticsearchContextMapper implements ContextMapper
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * TODO: find out how to get context information safely
     *
     * @var string
     */
    protected $contextUrlTemplate = 'http://data.swissbib.ch/{type}/context.jsonld';

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function fromInternalToExternal(string $type, array $internal) : array
    {
        $cacheKey = 'elasticsearch_context_mapper.from_internal_to_external.' . $type;

        if ($this->cache->contains($cacheKey)) {
            $mapping = $this->cache->fetch($cacheKey);
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function fromExternalToInternal(string $type, array $external) : array
    {
        $cacheKey = 'elasticsearch_context_mapper.from_external_to_internal.' . $type;

        if ($this->cache->contains($cacheKey)) {
            $mapping = $this->cache->fetch($cacheKey);
        }

        $externalContextUrl = str_replace('{type}', $type, $this->contextUrlTemplate);
        $externalContext = file_get_contents($externalContextUrl);

        $this->cache->save($cacheKey, []);

        $data = [];
        $data['id'] = $external['_id'];

        foreach ($external['_source'] as $propertyKey => $propertyValue) {
            if (strpos($propertyKey, ':') !== false) {
                list($namespace, $value) = explode(':', $propertyKey);

                $data[$value] = $external['_source'][$propertyKey];
            }
        }

        return $data;
    }
}
