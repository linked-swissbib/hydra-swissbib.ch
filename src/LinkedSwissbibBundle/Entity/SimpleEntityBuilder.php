<?php

namespace LinkedSwissbibBundle\Entity;

use Monolog\Logger;

class SimpleEntityBuilder implements EntityBuilder
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $type
     * @param array $properties
     *
     * @return object
     */
    public function build(string $type, array $properties)
    {
        if (!class_exists($type)) {
            $this->logger->error('Class "' . $type . '" not found.');

            return null;
        }

        $entity = new $type;

        foreach ($properties as $propertyName => $propertyValue) {
            $setterMethod = 'set' . ucfirst($propertyName);

            if (method_exists($entity, $setterMethod)) {
                $entity->{$setterMethod}($propertyValue);
            } else {
                $this->logger->warning('Property "' . $propertyName . '" is not mapped to the entity class "' . $type . '".');
            }
        }

        return $entity;
    }
}
