<?php

namespace LinkedSwissbibBundle\Elasticsearch;

use ElasticsearchAdapter\Params\ArrayParams;
use ElasticsearchAdapter\Params\Params;
use LinkedSwissbibBundle\ContextMapping\ContextMapper as ContextMapperInterface;
use LinkedSwissbibBundle\Params\ParamsBuilder as ParamsBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * ParamsBuilder
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ParamsBuilder implements ParamsBuilderInterface
{
    /**
     * @var ResourceNameConverter
     */
    protected $resourceNameConverter;

    /**
     * @var ContextMapperInterface
     */
    protected $contextMapper;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param ResourceNameConverter $resourceNameConverter
     * @param ContextMapperInterface $contextMapper
     */
    public function __construct(ResourceNameConverter $resourceNameConverter, ContextMapperInterface $contextMapper, array $config)
    {
        $this->resourceNameConverter = $resourceNameConverter;
        $this->contextMapper = $contextMapper;
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function buildItemParams(Request $request) : Params
    {
        $params = new ArrayParams();
        $id = $request->attributes->get('id');
        $resourceClass = $request->attributes->get('_api_resource_class');
        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);

        $params->set('id', $id)->set('type', $type);

        return $params;
    }

    /**
     * @inheritdoc
     */
    public function buildCollectionParams(Request $request) : Params
    {
        $params = new ArrayParams();
        $resourceClass = $request->attributes->get('_api_resource_class');
        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);

        foreach ($request->query->all() as $name => $value) {
            if (in_array($name, $this->config['mapped_params']['single'])) {
                $name = $this->contextMapper->fromInternalToExternal($type, $name);
            } elseif (in_array($name, $this->config['mapped_params']['multi'])) {
                $mappedValues = $this->contextMapper->fromInternalToExternal($type, explode(',', $value));
                $value = implode(',', $mappedValues);
            }

            $params->set($name, urldecode($value));
        }

        $params->set('type', $type);

        return $params;
    }
}
