<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\SearchBuilder\TemplateSearchBuilder;
use LinkedSwissbibBundle\ContextMapping\ContextMapper;
use LinkedSwissbibBundle\Elasticsearch\ResourceNameConverter;
use LinkedSwissbibBundle\Entity\EntityBuilder;
use LinkedSwissbibBundle\Paginator\ElasticsearchPaginator;
use LinkedSwissbibBundle\Params\ParamsBuilder;
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
     * @var TemplateSearchBuilder
     */
    protected $searchBuilder;

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
     * @param TemplateSearchBuilder $searchBuilder
     * @param EntityBuilder $entityBuilder
     * @param ContextMapper $contextMapper
     */
    public function __construct(Adapter $adapter, TemplateSearchBuilder $searchBuilder, EntityBuilder $entityBuilder, ContextMapper $contextMapper, RequestStack $requestStack, ResourceNameConverter $resourceNameConverter, ParamsBuilder $paramsBuilder)
    {
        $this->adapter = $adapter;
        $this->searchBuilder = $searchBuilder;
        $this->entityBuilder = $entityBuilder;
        $this->contextMapper = $contextMapper;
        $this->requestStack = $requestStack;
        $this->resourceNameConverter = $resourceNameConverter;
        $this->paramsBuilder = $paramsBuilder;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $params = $this->paramsBuilder->buildItemParams($this->requestStack->getCurrentRequest());

        $this->searchBuilder->setParams($params);

        $search = $this->searchBuilder->buildSearchFromTemplate('id');
        $response = $this->adapter->search($search);
        $mappedProperties = $this->contextMapper->fromExternalToInternal($resourceClass, $response->getHits());

        if (isset($mappedProperties[0])) {
            return $this->entityBuilder->build($resourceClass, $mappedProperties[0]);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);
        $params = $this->paramsBuilder->buildCollectionParams($this->requestStack->getCurrentRequest());
        $templateName = 'empty';
        $entities = [];
        $currentPage = 1;
        if ($params->has('q') && $params->has('fields')) {
            $templateName = 'collection_fields';
        } elseif ($params->has('q')) {
            $templateName = 'collection_' . strtolower($type);
        }

        $this->searchBuilder->setParams($params);
        $search = $this->searchBuilder->buildSearchFromTemplate($templateName);
        $search->setSize(20);
        $search->setFrom(($currentPage-1) * $search->getSize());
        $response = $this->adapter->search($search);
        $mappedEntities = $this->contextMapper->fromExternalToInternal($resourceClass, $response->getHits());

        foreach ($mappedEntities as $mappedEntity) {
            $entities[] = $this->entityBuilder->build($resourceClass, $mappedEntity);
        }
        return new ElasticsearchPaginator($response,$currentPage, $search->getSize());
    }
}

