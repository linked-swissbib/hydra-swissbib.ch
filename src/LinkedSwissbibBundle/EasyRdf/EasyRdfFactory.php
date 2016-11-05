<?php

namespace LinkedSwissbibBundle\EasyRdf;

use EasyRdf_Graph;
use EasyRdf_Namespace;

/**
 * EasyRdfFactory
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class EasyRdfFactory
{
    /**
     * @param array $namespaces
     *
     * @return EasyRdf_Graph
     */
    public static function createEasyRdfGraph(array $namespaces)
    {
        foreach ($namespaces as $prefix => $uri) {
            EasyRdf_Namespace::set($prefix, $uri);
        }

        return new EasyRdf_Graph();
    }
}
