<?php

namespace LinkedSwissbibBundle\Entity;

use Monolog\Logger;

/**
 * SimpleEntityBuilder
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
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
     * TODO implement subresource types like Address
     *
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
