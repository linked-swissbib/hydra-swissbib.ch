<?php

namespace LinkedSwissbibBundle\PathResolver;

use ApiPlatform\Core\PathResolver\OperationPathResolverInterface;
use Doctrine\Common\Inflector\Inflector;

class CamelCaseResourcePathGenerator implements OperationPathResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolveOperationPath(string $resourceShortName, array $operation, bool $collection) : string
    {
        if ($resourceShortName === 'Person') {
            $plural = 'Persons';
        } else {
            $plural = Inflector::pluralize($resourceShortName);
        }

        return lcfirst($plural);
    }
}
