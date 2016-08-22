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
            'type' => 'bibliographicResource',
            'id' => $id
        ];

        $response = $this->client->get($params);

        return $response;

        //return $response ? new BibliographicResource($response) : null;
    }
}
