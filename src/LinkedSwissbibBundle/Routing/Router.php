<?php

namespace LinkedSwissbibBundle\Routing;

use ApiPlatform\Core\Api\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;

class Router implements RouterInterface, UrlGeneratorInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function setContext(RequestContext $context)
    {
        $this->router->setContext($context);
    }

    /**
     * {@inheritdoc}
     */
    public function getContext()
    {
        return $this->router->getContext();
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteCollection()
    {
        return $this->router->getRouteCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function match($pathInfo)
    {
        return $this->router->match($pathInfo);
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, $parameters = [], $referenceType = RouterInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($name, $parameters, UrlGeneratorInterface::ABS_URL);
    }
}
