<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\PaginatorInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\Params\ArrayParams;
use ElasticsearchAdapter\Params\Params;
use ElasticsearchAdapter\QueryBuilder\TemplateQueryBuilder;
use LinkedSwissbibBundle\ContextMapping\ContextMapper;
use LinkedSwissbibBundle\Entity\EntityBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

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
     * @param Adapter $adapter
     * @param TemplateQueryBuilder $queryBuilder
     * @param EntityBuilder $entityBuilder
     * @param ContextMapper $contextMapper
     */
    public function __construct(Adapter $adapter, TemplateQueryBuilder $queryBuilder, EntityBuilder $entityBuilder, ContextMapper $contextMapper, RequestStack $requestStack)
    {
        $this->adapter = $adapter;
        $this->queryBuilder = $queryBuilder;
        $this->entityBuilder = $entityBuilder;
        $this->contextMapper = $contextMapper;
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, bool $fetchData = false)
    {
        $params = $this->buildParamsFromResource($resourceClass, $id);
        $this->queryBuilder->setParams($params);
        $query = $this->queryBuilder->buildQueryFromTemplate('id');

        $response = $this->adapter->search($query, $params);

        $mappedProperties = $this->contextMapper->fromExternalToInternal($this->getElasticsearchTypeFromResourceClass($resourceClass), $response);
        $entity = $this->entityBuilder->build($resourceClass, $mappedProperties);

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $type = $this->getElasticsearchTypeFromResourceClass($resourceClass);
        $params = $this->buildParamsFromRequest($this->requestStack->getCurrentRequest(), $type)->set('type', $type);

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

        return $entities;
    }

    /**
     * @param string $resourceClass
     *
     * @return string
     */
    protected function getElasticsearchTypeFromResourceClass(string $resourceClass) : string
    {
        $namespaceParts = explode('\\', $resourceClass);
        $className = array_pop($namespaceParts);

        if ($className === 'Organization') {
            $className = 'Organisation'; // TODO rename
        }

        $type = lcfirst($className);

        return $type;
    }

    /**
     * @param Request $request
     * @param string $type
     *
     * @return Params
     */
    protected function buildParamsFromRequest(Request $request, string $type) : Params
    {
        $params = new ArrayParams();

        foreach ($request->query->all() as $name => $value) {
            if ($name === 'fields') {
                $mappedValues = $this->contextMapper->fromInternalToExternal($type, explode(',', $value));
                $value = implode(',', $mappedValues);
            }

            $params->set($name, urldecode($value));
        }

        return $params;
    }

    /**
     * @param string $resourceClass
     * @param $id
     *
     * @return Params
     */
    protected function buildParamsFromResource(string $resourceClass, $id) : Params
    {
        $params = new ArrayParams();

        $params->set('id', $id)->set('type', $this->getElasticsearchTypeFromResourceClass($resourceClass));

        return $params;
    }
}
