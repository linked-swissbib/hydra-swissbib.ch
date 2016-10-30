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
        $response = [
            'took' => 2,
            'timed_out' => false,
            '_shards' => [
                'total' => 5,
                'successful' => 5,
                'failed' => 0,
            ],
            'hits' => [
                'total' => 1,
                'max_score' => 1.0,
                'hits' => [
                    0 => [
                        '_index' => 'testsb_160426',
                        '_type' => 'document',
                        '_id' => '000000051',
                        '_score' => 1.0,
                        '_source' => [
                            '@type' => 'http://purl.org/ontology/bibo/document',
                            '@context' => 'http://data.swissbib.ch/document/context.jsonld',
                            'dct:issued' => '2016-04-26T08:41:49.227Z',
                            '@id' => 'http://data.swissbib.ch/resource/000000051/about',
                            'foaf:primaryTopic' => 'http://data.swissbib.ch/resource/000000051/about',
                            'dct:modified' => '2014-08-14T16:40:57+01:00',
                            'dct:contributor' => [
                                0 => 'http://d-nb.info/gnd/1046905-9',
                                1 => 'http://data.swissbib.ch/agent/ABN',
                            ],
                            'bf:local' => [
                                0 => 'OCoLC/775794624',
                                1 => 'ABN/000300043',
                            ],
                        ],
                    ],
                ],
            ],
        ];
        
        return new ElasticsearchClientResult($response);
    }
}
