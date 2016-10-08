<?php

namespace LinkedSwissbibBundle\ContextMapping;

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
