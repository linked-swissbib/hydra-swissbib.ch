<?php

namespace LinkedSwissbibBundle\Entity;

/**
 * EntityBuilder
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
interface EntityBuilder
{
    /**
     * @param string $type
     * @param array $properties
     *
     * @return object
     */
    public function build(string $type, array $properties);
}
