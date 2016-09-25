<?php

namespace LinkedSwissbibBundle\Naming;

use ApiPlatform\Core\Naming\ResourcePathNamingStrategyInterface;
use Doctrine\Common\Inflector\Inflector;

class CamelCaseResourcePathGenerator implements ResourcePathNamingStrategyInterface
{
    /**
     * Generates the base path.
     *
     * @param string $resourceShortName
     *
     * @return string
     */
    public function generateResourceBasePath(string $resourceShortName) : string
    {
        if ($resourceShortName === 'Person') {
            $plural = 'Persons';
        } else {
            $plural = Inflector::pluralize($resourceShortName);
        }

        return lcfirst($plural);
    }
}
