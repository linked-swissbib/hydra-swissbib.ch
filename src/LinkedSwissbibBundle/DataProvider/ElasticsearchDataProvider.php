<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use Elasticsearch\Client;

class ElasticsearchDataProvider implements ItemDataProviderInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * ElasticsearchDataProvider constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
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
        $type = lcfirst($className);

        return $type;
    }
}
