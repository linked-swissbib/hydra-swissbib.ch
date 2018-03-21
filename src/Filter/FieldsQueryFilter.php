<?php
namespace LinkedSwissbibBundle\Filter;

use ApiPlatform\Core\Api\FilterInterface;

/**
 * FieldsQueryFilter
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class FieldsQueryFilter implements FilterInterface
{
    /**
     * @inheritdoc
     */
    public function getDescription(string $resourceClass) : array
    {
        return [
            'q' => [
                'property' => '_all',
                'type' => 'string',
                'required' => false,
                'strategy' => '',
                'swagger' => [
                    'description' => 'The search query e.g. q=linked+data'
                ],
            ],
            'fields' => [
                'property' => '_fields',
                'type' => 'string',
                'required' => false,
                'strategy' => '',
                'swagger' => [
                    'description' => 'The fields to be searched e.g. fields=local,contributor'
                ],
            ],
        ];
    }
}
