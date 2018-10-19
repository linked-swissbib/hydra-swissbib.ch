<?php

namespace LinkedSwissbibBundle\PathResolver;

use ApiPlatform\Core\Operation\PathSegmentNameGeneratorInterface;

/**
 * CamelCaseResourcePathGenerator
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>
 * @author   Markus Mächler <markus.maechler@students.fhnw.ch>
 * @author   Günter Hipler  <guenter.hipler@unibas.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class CamelCaseResourcePathGenerator implements PathSegmentNameGeneratorInterface
{
    public function getSegmentName(string $name, bool $collection = true): string
    {
        return lcfirst($name);
    }
}
