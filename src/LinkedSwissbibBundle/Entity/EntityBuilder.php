<?php

namespace LinkedSwissbibBundle\Entity;

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