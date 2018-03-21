<?php
namespace LinkedSwissbibBundle\Tests\ElasticsearchAdapter;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\ServerErrorResponseException;
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
     *
     * @throws BadRequest400Exception
     * @throws ServerErrorResponseException
     */
    public function search(Search $search) : Result
    {
        if ($search->getFrom() < 0) {
            throw new BadRequest400Exception();
        }

        if ($search->getFrom() > 10000) {
            throw new ServerErrorResponseException('Result window is too large');
        }

        $type = $search->getType();
        $isCollection = !$search->getQuery()->getParams()->has('id');
        $filePath = __DIR__ . '/../../../../tests/Resources/ElasticsearchResults/' . ($isCollection ? $type . 's' : $type) . '.json';
        $response = json_decode(file_get_contents($filePath), true);
        
        return new ElasticsearchClientResult($response);
    }
}
