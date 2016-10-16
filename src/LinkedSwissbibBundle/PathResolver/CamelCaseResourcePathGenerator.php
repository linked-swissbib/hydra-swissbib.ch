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
            $path = 'Persons';
        } else {
            $path = Inflector::pluralize($resourceShortName);
        }

        $path = lcfirst($path);

        if (!$collection) {
            $path .= '/{id}';
        }

        $path .= '.{_format}';

        return $path;
    }
}
