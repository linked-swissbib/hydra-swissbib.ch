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
        $query = $this->queryBuilder->buildQueryFromTemplate('id');
        $params = (new ArrayParams())
            ->set('id', $id)
            ->set('type', $this->getElasticsearchTypeFromResourceClass($resourceClass));

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
        $template = $this->getElasticsearchTypeFromResourceClass($resourceClass);
        $query = $this->queryBuilder->buildQueryFromTemplate($template);
        $params = $this->buildParamsFromRequest($this->requestStack->getCurrentRequest());
        $response = $this->adapter->search($query, $params);
        $mappedEntities = $this->contextMapper->fromExternalToInternal($this->getElasticsearchTypeFromResourceClass($resourceClass), $response);
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
     *
     * @return Params
     */
    protected function buildParamsFromRequest(Request $request) : Params
    {
        $params = new ArrayParams();

        foreach ($request->query->all() as $name => $value) {
            $params->set($name, $value);
        }

        return $params;
    }
}
