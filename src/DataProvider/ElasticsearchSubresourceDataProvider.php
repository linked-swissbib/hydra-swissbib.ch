<?php

namespace LinkedSwissbibBundle\DataProvider;

use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\Exception\RuntimeException;
use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\SearchBuilder\TemplateSearchBuilder;
use LinkedSwissbibBundle\Elasticsearch\ContextMapper;
use LinkedSwissbibBundle\Elasticsearch\ResourceNameConverter;
use LinkedSwissbibBundle\Entity\Address;
use LinkedSwissbibBundle\Entity\EntityBuilder;
use LinkedSwissbibBundle\Exception\ApiExceptionTransformer;
use LinkedSwissbibBundle\Params\ParamsBuilder;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * ElasticsearchSubresourceDataProvider
 *
 * @author   Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
final class ElasticsearchSubresourceDataProvider implements SubresourceDataProviderInterface
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
     * {@inheritdoc}
     *
     * @throws RuntimeException
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, string $operationName = null)
    {
        if (!isset($context['identifiers'], $context['property']) || $context['property'] !== 'address') {
            throw new ResourceClassNotSupportedException('The given resource class is not a subresource.');
        }

        //TODO retrieve correct address through Elasticsearch adapter and entityBuilder
        $organisationId = $identifiers['id']['id'];
        $address = new Address();
        $address->setId('lorem-ipsum-id');
        $address->setRegion('Zurich');
        $address->setPostalcode('8057');
        $address->setStreetaddress('Milchbuckstrasse 83');
        $address->setLocality('');

        return $address;
    }
}
