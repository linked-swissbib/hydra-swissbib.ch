<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\SearchBuilder\TemplateSearchBuilder;
use LinkedSwissbibBundle\ContextMapping\ContextMapper;
use LinkedSwissbibBundle\Elasticsearch\ResourceNameConverter;
use LinkedSwissbibBundle\Entity\EntityBuilder;
use LinkedSwissbibBundle\Exception\ApiExceptionTransformer;
use LinkedSwissbibBundle\Paginator\ElasticsearchPaginator;
use LinkedSwissbibBundle\Params\ParamsBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Exception;

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
     * @var ApiExceptionTransformer
     */
    protected $apiExceptionTransformer;

    /**
     * @param Adapter $adapter
     * @param TemplateSearchBuilder $searchBuilder
     * @param EntityBuilder $entityBuilder
     * @param ContextMapper $contextMapper
     * @param RequestStack $requestStack
     * @param ResourceNameConverter $resourceNameConverter
     * @param ParamsBuilder $paramsBuilder
     * @param ApiExceptionTransformer $apiExceptionTransformer
     */
    public function __construct(Adapter $adapter, TemplateSearchBuilder $searchBuilder, EntityBuilder $entityBuilder, ContextMapper $contextMapper, RequestStack $requestStack, ResourceNameConverter $resourceNameConverter, ParamsBuilder $paramsBuilder, ApiExceptionTransformer $apiExceptionTransformer)
    {
        $this->adapter = $adapter;
        $this->searchBuilder = $searchBuilder;
        $this->entityBuilder = $entityBuilder;
        $this->contextMapper = $contextMapper;
        $this->requestStack = $requestStack;
        $this->resourceNameConverter = $resourceNameConverter;
        $this->paramsBuilder = $paramsBuilder;
        $this->apiExceptionTransformer = $apiExceptionTransformer;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $params = $this->paramsBuilder->buildItemParams($this->requestStack->getCurrentRequest());

        $this->searchBuilder->setParams($params);

        try {
            $search = $this->searchBuilder->buildSearchFromTemplate('id');
            $response = $this->adapter->search($search);
            $mappedProperties = $this->contextMapper->fromExternalToInternal($resourceClass, $response->getHits());
        } catch (Exception $e) {
            $this->apiExceptionTransformer->transformException($e);
        }

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
        $request = $this->requestStack->getCurrentRequest();
        $params = $this->paramsBuilder->buildCollectionParams($request);
        $templateName = 'empty';
        $entities = [];
        $currentPage = $request->query->has('page') ? $request->query->get('page') : 1;

        if ($params->has('q') && $params->has('fields')) {
            $templateName = 'collection_fields';
        } elseif ($params->has('q')) {
            $templateName = 'collection_' . strtolower($type);
        }

        try {
            $this->searchBuilder->setParams($params);
            $search = $this->searchBuilder->buildSearchFromTemplate($templateName);
            $search->setFrom(($currentPage-1) * $search->getSize());

            $result = $this->adapter->search($search);
        } catch (Exception $e) {
            $this->apiExceptionTransformer->transformException($e);
        }

        $mappedEntities = $this->contextMapper->fromExternalToInternal($resourceClass, $result->getHits());

        foreach ($mappedEntities as $mappedEntity) {
            $entities[] = $this->entityBuilder->build($resourceClass, $mappedEntity);
        }

        return new ElasticsearchPaginator($result, $entities, $search->getSize(), $currentPage);
    }
}
