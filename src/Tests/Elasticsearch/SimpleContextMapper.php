<?php

namespace LinkedSwissbibBundle\Tests\Elasticsearch;

use LinkedSwissbibBundle\ContextMapping\ContextMapper as ContextMapperInterface;
use Symfony\Component\Intl\Exception\MethodNotImplementedException;

/**
 * SimpleContextMapper, used for testing in order to avoid calls to external resources
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class SimpleContextMapper implements ContextMapperInterface
{
    /**
     * {@inheritdoc}
     */
    public function fromInternalToExternal(string $type, array $internal) : array
    {
        return $internal;
    }

    /**
     * {@inheritdoc}
     */
    public function fromExternalToInternal(string $type, array $external) : array
    {
        $data = [];

        foreach ($external as $hits) {
            $entity = [];

            foreach ($hits['_source'] as $propertyKey => $propertyValue) {
                if (strpos($propertyKey, ':') !== false) {
                    list($namespace, $value) = explode(':', $propertyKey);

                    $entity[$value] = $hits['_source'][$propertyKey];
                }
            }

            $entity['id'] = $hits['_id'];
            $data[] = $entity;
        }

        return $data;
    }
}
