<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use Elasticsearch\Client;
use LinkedSwissbibBundle\ContextMapping\ContextMapper;
use LinkedSwissbibBundle\Entity\EntityBuilder;

class ElasticsearchDataProvider implements ItemDataProviderInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var EntityBuilder
     */
    protected $entityBuilder;

    /**
     * @var ContextMapper
     */
    protected $contextMapper;

    /**
     * @param Client $client
     * @param EntityBuilder $entityBuilder
     * @param ContextMapper $contextMapper
     */
    public function __construct(Client $client, EntityBuilder $entityBuilder, ContextMapper $contextMapper)
    {
        $this->client = $client;
        $this->entityBuilder = $entityBuilder;
        $this->contextMapper = $contextMapper;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, bool $fetchData = false)
    {
        $params = [
            'index' => 'testsb_160426',
            'type' => $this->getElasticsearchTypeFromResourceClass($resourceClass),
            'id' => $id
        ];

        $response = $this->client->get($params);
        $mappedProperties = $this->contextMapper->fromExternalToInternal($this->getElasticsearchTypeFromResourceClass($resourceClass), $response);
        $entity = $this->entityBuilder->build($resourceClass, $mappedProperties);

        return $response ? new $resourceClass($response) : null;
    }

    /**
     * @param string $resourceClass
     *
     * @return string
     */
    protected function getElasticsearchTypeFromResourceClass(string $resourceClass)
    {
        $namespaceParts = explode('\\', $resourceClass);
        $className = array_pop($namespaceParts);

        if ($className === 'Organization') {
            $className = 'Organisation'; // TODO rename
        }

        $type = lcfirst($className);

        return $type;
    }
}
