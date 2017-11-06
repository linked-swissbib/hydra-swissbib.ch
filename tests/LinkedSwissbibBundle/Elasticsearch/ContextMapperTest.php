<?php

namespace Tests\LinkedSwissbibBundle\Elasticsearch;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use ApiPlatform\Core\Metadata\Property\PropertyNameCollection;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use LinkedSwissbibBundle\Elasticsearch\ContextMapper;
use LinkedSwissbibBundle\Elasticsearch\ResourceNameConverter;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ProphecyInterface;

/**
 * ContextMapperTest
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ContextMapperTest extends TestCase
{
    /**
     * @var ContextMapper
     */
    protected $contextMapper;

    /**
     * @var ProphecyInterface
     */
    protected $cacheProphecy;

    /**
     * @var ProphecyInterface
     */
    protected $clientProphecy;

    /**
     * @var ProphecyInterface
     */
    protected $resourceNameConverterProphecy;

    /**
     * @var ProphecyInterface
     */
    protected $propertyNameCollectionFactoryProphecy;

    /**
     * @var ProphecyInterface
     */
    protected $propertyMetadataFactoryProphecy;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->cacheProphecy = $this->prophesize(Cache::class);
        $this->clientProphecy = $this->prophesize(Client::class);
        $this->resourceNameConverterProphecy = $this->prophesize(ResourceNameConverter::class);
        $this->propertyNameCollectionFactoryProphecy = $this->prophesize(PropertyNameCollectionFactoryInterface::class);
        $this->propertyMetadataFactoryProphecy = $this->prophesize(PropertyMetadataFactoryInterface::class);
    }

    /**
     * @return void
     */
    public function testFromInternalToExternal()
    {
        $resourceClass = '\\Entities\\Dummy';

        $this->cacheProphecy->contains('elasticsearch_context_mapper.' . $resourceClass)->willReturn(false);
        $this->cacheProphecy->save("elasticsearch_context_mapper.\Entities\Dummy", [
            "internal_to_external" => ["attra" => "prefixa:attra", "attrb" => "prefixb:attrb"],
            "external_to_internal" => ["prefixa:attra" => "attra", "prefixb:attrb" => "attrb"]
        ])->willReturn();

        $this->resourceNameConverterProphecy->getElasticsearchTypeFromResourceClass($resourceClass)->willReturn('dummy');
        $this->propertyNameCollectionFactoryProphecy->create($resourceClass)->willReturn(new PropertyNameCollection([
            'attrA',
            'attrB'
        ]));
        $this->propertyMetadataFactoryProphecy->create($resourceClass, 'attrA')->willReturn(
            new PropertyMetadata(null, null, null, null, null, null, null, null, 'http://example-a.com/some/path/attrA')
        );
        $this->propertyMetadataFactoryProphecy->create($resourceClass, 'attrB')->willReturn(
            new PropertyMetadata(null, null, null, null, null, null, null, null, 'http://example-b.com/some/path/attrB')
        );
        $this->clientProphecy->get('http://exmple.com/dummy')->willReturn(new Response(
            200,
            [],
            json_encode([
                '@context' => [
                    'prefixA' => 'http://example-a.com/some/path/',
                    'prefixB' => 'http://example-b.com/some/path/',
                    'prefixA:attrA' => ['@type' => '@id'],
                ],
            ])
        ));

        $this->initContextMapper();

        $this->assertEquals(
            ['prefixa:attra', 'prefixb:attrb', 'attrc'],
            $this->contextMapper->fromInternalToExternal($resourceClass, ['attra', 'attrb', 'attrc'])
        );

        $this->assertEquals(
            ['prefixa:attra'],
            $this->contextMapper->fromInternalToExternal($resourceClass, ['attra'])
        );
    }

    /**
     * @return void
     */
    public function testFromExternalToInternalCached()
    {
        $resourceClass = '\\Entities\\Dummy';

        $this->cacheProphecy->contains('elasticsearch_context_mapper.' . $resourceClass)->willReturn(true);
        $this->cacheProphecy->fetch("elasticsearch_context_mapper.\Entities\Dummy")->willReturn([
            "internal_to_external" => [
                "attrA" => "prefixA:attrA",
                "attrB" => "prefixB:attrB"
            ],
            "external_to_internal" => ["prefixA:attrA" => "attrA", "prefixB:attrB" => "attrB"]
        ]);
        $this->resourceNameConverterProphecy->getElasticsearchTypeFromResourceClass($resourceClass)->willReturn('dummy');
        $this->propertyNameCollectionFactoryProphecy->create($resourceClass)->willReturn(new PropertyNameCollection([
            'attrA',
            'attrB'
        ]));
        $this->propertyMetadataFactoryProphecy->create($resourceClass, 'attrA')->willReturn(
            new PropertyMetadata(null, null, null, null, null, null, null, null, 'http://example-a.com/some/path/attrA')
        );
        $this->propertyMetadataFactoryProphecy->create($resourceClass, 'attrB')->willReturn(
            new PropertyMetadata(null, null, null, null, null, null, null, null, 'http://example-b.com/some/path/attrB')
        );
        $this->clientProphecy->get('http://exmple.com/dummy')->willReturn(new Response(
            200,
            [],
            json_encode([
                '@context' => [
                    'prefixA' => 'http://example-a.com/some/path/',
                    'prefixB' => 'http://example-b.com/some/path/',
                    'prefixA:attrA' => ['@type' => '@id'],
                    'prefixB:attrB' => ['@type' => '@id'],
                ],
            ])
        ));

        $this->initContextMapper();

        $this->assertEquals(
            [['id' => 'someId', 'attrA' => 'valueA', 'attrB' => 'valueB']],
            $this->contextMapper->fromExternalToInternal($resourceClass, [
                [
                    '_id' => 'someId',
                    '_source' => [
                        'prefixA:attrA' => 'valueA',
                        'prefixB:attrB' => 'valueB',
                        'prefixC:attrC' => 'valueC',
                    ],
                ]
            ])
        );
    }

    /**
     * @param array $config
     *
     * @return void
     */
    protected function initContextMapper(array $config = null)
    {
        $this->contextMapper = new ContextMapper(
            $this->cacheProphecy->reveal(),
            $this->clientProphecy->reveal(),
            $config ?? ['template_url' => 'http://exmple.com/{type}'],
            $this->resourceNameConverterProphecy->reveal(),
            $this->propertyNameCollectionFactoryProphecy->reveal(),
            $this->propertyMetadataFactoryProphecy->reveal()
        );
    }
}
