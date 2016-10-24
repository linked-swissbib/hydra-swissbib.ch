<?php

namespace Tests\LinkedSwissbibBundle\DataProvider;

use ElasticsearchAdapter\Connector\ElasticsearchClientConnector;
use ElasticsearchAdapter\QueryBuilder\TemplateQueryBuilder;
use Symfony\Component\Yaml\Yaml;
use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\Query\Query;
use ElasticsearchAdapter\Params\ArrayParams;


class ElasticsearchDataProviderTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @var ElasticsearchClientConnector
     */
    private $esClientConnector;


    /**
     * @var array
     */
    private $queryTemplates;


    /**
     * @return void
     */
    public function setUp()
    {

        //todo: @Markus -  how can we determine the App-Root directory so tests can be called from console using
        //phpunit as well as within IDE
        //$paramaters =  Yaml::parse(file_get_contents('../../../app/config/elasticsearch_adapter.yml'));
        $paramaters =  Yaml::parse(file_get_contents('app/config/elasticsearch_adapter.yml'));
        $this->queryTemplates = $paramaters["parameters"]["elasticsearch_adapter.templates"];
        $this->esClientConnector = new ElasticsearchClientConnector($paramaters["parameters"]["elasticsearch_adapter.hosts"]);

    }


    public function testAdapter()
    {

        $adapter = new Adapter($this->esClientConnector);
        $templateQueryBuilder = new TemplateQueryBuilder($this->queryTemplates,new ArrayParams());

        //todo: @Markus - what's the idea to set variables part of a template - in the current case q and fields
        $query = $templateQueryBuilder->buildQueryFromTemplate("search");

        $this->assertNotNull($query instanceof Query);

        $result =  $adapter->search($query,new ArrayParams());

        $this->assertTrue(is_array($result));

        $this->assertArrayHasKey("hits",$result,"ES result array doesn't contain expected key hits");

        $this->assertTrue($result["hits"]["total"] == 0,"expected number of hits == 0 isn't true");


    }


}