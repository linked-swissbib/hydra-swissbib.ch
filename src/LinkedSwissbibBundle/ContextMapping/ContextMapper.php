<?php

namespace LinkedSwissbibBundle\ContextMapping;

/**
 * ContextMapper
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
interface ContextMapper
{
    /**
     * @param string $type
     * @param array $internal
     *
     * @return array
     */
    public function fromInternalToExternal(string $type, array $internal) : array;

    /**
     * @param string $type
     * @param array $external
     *
     * @return array
     */
    public function fromExternalToInternal(string $type, array $external) : array;
}
