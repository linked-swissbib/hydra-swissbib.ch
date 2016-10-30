<?php
namespace LinkedSwissbibBundle\Tests\ElasticsearchAdapter;

use ElasticsearchAdapter\Adapter;
use ElasticsearchAdapter\Result\ElasticsearchClientResult;
use ElasticsearchAdapter\Result\Result;
use ElasticsearchAdapter\Search\Search;

/**
 * ElasticsearchAdapterMock
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ElasticsearchAdapterMock extends Adapter
{
    /**
     * @param Search $search
     *
     * @return Result
     */
    public function search(Search $search) : Result
    {
        $type = $search->getType();
        $isCollection = !$search->getQuery()->getParams()->has('id');
        $filePath = __DIR__ . '/../../../../tests/Resources/ElasticsearchResults/' . ($isCollection ? $type . 's' : $type) . '.json';
        $response = json_decode(file_get_contents($filePath), true);
        
        return new ElasticsearchClientResult($response);
    }
}
