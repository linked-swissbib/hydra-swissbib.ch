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


    public function resolveOperationPath(string $resourceShortName, array $operation, $operationType/*, string $operationName = null*/): string
    {
        //$path = '/' . lcfirst($resourceShortName);
        $path = '/' . $resourceShortName;

        if (!$operationType) {
            $path .= '/{id}';
        }

        $path .= '.{_format}';

        return $path;
    }

    /**
     * @inheritdoc
     */
    /*
    public function resolveOperationPath(string $resourceShortName, array $operation, bool $collection) : string
    {
        $path = '/' . lcfirst($resourceShortName);

        if (!$collection) {
            $path .= '/{id}';
        }

        $path .= '.{_format}';

        return $path;

    } */



}
