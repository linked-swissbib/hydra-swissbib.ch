<?php
namespace LinkedSwissbibBundle\Elasticsearch;

/**
 * ResourceNameConverter
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ResourceNameConverter
{
    /**
     * @param string $resourceClass
     *
     * @return string
     */
    public function getElasticsearchTypeFromResourceClass(string $resourceClass) : string
    {
        $namespaceParts = explode('\\', $resourceClass);
        $className = array_pop($namespaceParts);

        $type = lcfirst($className);

        return $type;
    }
}
