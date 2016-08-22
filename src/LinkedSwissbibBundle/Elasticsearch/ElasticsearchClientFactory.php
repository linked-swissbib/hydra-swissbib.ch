<?php

namespace LinkedSwissbibBundle\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticsearchClientFactory
{
    /**
     * @param array $hosts
     *
     * @return Client
     */
    public static function createClient(array $hosts)
    {
        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        return $client;
    }
}
