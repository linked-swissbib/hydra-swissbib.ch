<?php

namespace LinkedSwissbibBundle\PathResolver;

use ApiPlatform\Core\PathResolver\OperationPathResolverInterface;
use Doctrine\Common\Inflector\Inflector;

/**
 * CamelCaseResourcePathGenerator
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class CamelCaseResourcePathGenerator implements OperationPathResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolveOperationPath(string $resourceShortName, array $operation, bool $collection) : string
    {
        $path = lcfirst($resourceShortName);

        if (!$collection) {
            $path .= '/{id}';
        }

        $path .= '.{_format}';

        return $path;
    }
}
