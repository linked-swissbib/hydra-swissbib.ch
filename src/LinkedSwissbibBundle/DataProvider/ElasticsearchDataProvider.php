<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\Params\ArrayParams;
use ElasticsearchAdapter\Params\Params;
use ElasticsearchAdapter\QueryBuilder\TemplateQueryBuilder;
use LinkedSwissbibBundle\ContextMapping\ContextMapper;
use LinkedSwissbibBundle\Elasticsearch\ResourceNameConverter;
use LinkedSwissbibBundle\Entity\EntityBuilder;
use LinkedSwissbibBundle\Params\ParamsBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * ElasticsearchDataProvider
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ElasticsearchDataProvider implements ItemDataProviderInterface, CollectionDataProviderInterface
{
    /**
     * @var Adapter
     */
    protected $adapter;
    /**
     * @var TemplateQueryBuilder
     */
    protected $queryBuilder;

    /**
     * @var EntityBuilder
     */
    protected $entityBuilder;

    /**
     * @var ContextMapper
     */
    protected $contextMapper;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var ResourceNameConverter
     */
    protected $resourceNameConverter;

    /**
     * @var ParamsBuilder
     */
    protected $paramsBuilder;

    /**
     * @param Adapter $adapter
     * @param TemplateQueryBuilder $queryBuilder
     * @param EntityBuilder $entityBuilder
     * @param ContextMapper $contextMapper
     */
    public function __construct(Adapter $adapter, TemplateQueryBuilder $queryBuilder, EntityBuilder $entityBuilder, ContextMapper $contextMapper, RequestStack $requestStack, ResourceNameConverter $resourceNameConverter, ParamsBuilder $paramsBuilder)
    {
        $this->adapter = $adapter;
        $this->queryBuilder = $queryBuilder;
        $this->entityBuilder = $entityBuilder;
        $this->contextMapper = $contextMapper;
        $this->requestStack = $requestStack;
        $this->resourceNameConverter = $resourceNameConverter;
        $this->paramsBuilder = $paramsBuilder;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, bool $fetchData = false)
    {
        $params = $this->paramsBuilder->buildItemParams($this->requestStack->getCurrentRequest());
        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);

        $this->queryBuilder->setParams($params);

        $query = $this->queryBuilder->buildQueryFromTemplate('id');
        $response = $this->adapter->search($query, $params);
        $mappedProperties = $this->contextMapper->fromExternalToInternal($type, $response);
        $entity = $this->entityBuilder->build($resourceClass, $mappedProperties);

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);
        $params = $this->paramsBuilder->buildCollectionParams($this->requestStack->getCurrentRequest());

        $this->queryBuilder->setParams($params);

        if ($params->has('q')) {
            $query = $this->queryBuilder->buildQueryFromTemplate('collection');
        } else {
            $query = $this->queryBuilder->buildQueryFromTemplate('empty');
        }

        $response = $this->adapter->search($query, $params);

        $mappedEntities = $this->contextMapper->fromExternalToInternal($type, $response);
        $entities = [];

        foreach ($mappedEntities as $mappedEntity) {
            $entities[] = $this->entityBuilder->build($resourceClass, $mappedEntity);
        }

        //TODO return new Paginator...
        return $entities;
    }
}
