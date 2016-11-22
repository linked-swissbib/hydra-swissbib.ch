<?php

namespace LinkedSwissbibBundle\Elasticsearch;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client;
use LinkedSwissbibBundle\ContextMapping\ContextMapper as ContextMapperInterface;

/**
 * ElasticsearchContextMapper
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ContextMapper implements ContextMapperInterface
{
    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var PropertyMetadataFactoryInterface
     */
    protected $propertyMetadataFactory;

    /**
     * @var PropertyNameCollectionFactoryInterface
     */
    protected $propertyNameCollectionFactory;

    /**
     * @var ResourceNameConverter
     */
    protected $resourceNameConverter;

    /**
     * @param Cache $cache
     * @param Client $client
     * @param array $config
     * @param ResourceNameConverter $resourceNameConverter
     * @param PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory
     * @param PropertyMetadataFactoryInterface $propertyMetadataFactory
     */
    public function __construct(Cache $cache, Client $client, array $config, ResourceNameConverter $resourceNameConverter, PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory, PropertyMetadataFactoryInterface $propertyMetadataFactory)
    {
        $this->cache = $cache;
        $this->client = $client;
        $this->config = $config;
        $this->resourceNameConverter = $resourceNameConverter;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function fromInternalToExternal(string $resourceClass, array $internal) : array
    {
        $mapping = $this->loadCachedMapping($resourceClass);
        $mappedValues = [];

        foreach ($internal as $property) {
            $mappedValues[] = $mapping['internal_to_external'][$property] ?? $property;
        }

        return $mappedValues;
    }

    /**
     * {@inheritdoc}
     */
    public function fromExternalToInternal(string $resourceClass, array $external) : array
    {
        $mapping = $this->loadCachedMapping($resourceClass);
        $mappedValues = [];

        foreach ($external as $hits) {
            $entity = [];

            foreach ($hits['_source'] as $propertyKey => $propertyValue) {
                if (strpos($propertyKey, '@') === false && isset($mapping['external_to_internal'][$propertyKey])) {
                    $internalPropertyName = $mapping['external_to_internal'][$propertyKey];
                    $entity[$internalPropertyName] = $hits['_source'][$propertyKey];
                }
            }

            $entity['id'] = $hits['_id'];
            $mappedValues[] = $entity;
        }

        return $mappedValues;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    protected function loadRemoteContext(string $type) : array
    {
        //todo: Remove when we have decided whether its resource or bibliographicResource
        if ($type === 'bibliographicResource') {
            $type = 'resource';
        }

        $url = str_replace('{type}', $type, $this->config['template_url']);

        $response = $this->client->get($url);
        $body = $response->getBody();

        return json_decode($body, true);
    }

    /**
     * @param string $resourceClass
     *
     * @return array
     */
    protected function loadCachedMapping(string $resourceClass) : array
    {
        $cacheKey = 'elasticsearch_context_mapper.' . $resourceClass;

        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);
        $remoteContext = $this->loadRemoteContext($type);
        $propertyNames = $this->propertyNameCollectionFactory->create($resourceClass);
        $remoteNamespaces = [];
        $mapping = [
            'internal_to_external' => [],
            'external_to_internal' => [],
        ];

        foreach ($remoteContext['@context'] as $propertyKey => $propertyValue) {
            if (strpos($propertyKey, ':') === false) {
                $remoteNamespaces[$propertyKey] = $propertyValue;
            }
        }

        foreach ($propertyNames as $propertyName) {
            $propertyMetaData = $this->propertyMetadataFactory->create($resourceClass, $propertyName);
            $iri = $propertyMetaData->getIri();

            foreach ($remoteNamespaces as $prefix => $namespace) {
                if (substr($iri, 0, strlen($namespace)) === $namespace) {
                    $remoteName = $prefix . ':' . $propertyName;

                    $mapping['internal_to_external'][$propertyName] = $remoteName;
                    $mapping['external_to_internal'][$remoteName] = $propertyName;
                }
            }
        }

        $this->cache->save($cacheKey, $mapping);

        return $mapping;
    }
}
