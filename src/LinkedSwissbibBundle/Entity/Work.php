<?php
/**
 * Created by PhpStorm.
 * User: Melanie
 * Date: 16.08.2016
 * Time: 11:35
 */

namespace LinedSwissbibBundle\Entity;
/**
 * A work.
 *
 * @see http://bibframe.org/vocab/Work
 *
 * @ApiResource(
 *     iri="http://bibframe.org/vocab/Work",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class Work
{

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/hasInstance");
     *
     */
    private $hasInstance;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor");
     *
     */
    private $contributor;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/title");
     *
     */
    private $title;

    /**
     * @var array
     *
     * @ApiProperty(readable=false)
     */
    private $source;


    /**
     * Work constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->id = $response['_id'];
        $this->context = $response['_source'];
        $this->type = $response['_source'];
        $this->hasInstance = $response['_source']['bf:hasInstance'] ?? null;
        $this->contributor = $response['_source']['dct:contributor']?? null;
        $this->title = $response['_source']['dct:title'] ?? null;
        $this->source = $response['_source'];
    }

    /**
     * @return string
     */
    public function geId() 
    {
        return $this->id ?? '';
    }
    /**
     * @return array
     */
    public function getSource() : array
    {
        return $this->source;
    }
    /**
     * @return string
     */
    public function getHasInstance() 
    {
        return $this->hasInstance ?? '';
    }
    /**
     * @return string
     */
    public function getContributor() 
    {
        return $this->contributor ?? '';
    }
    /**
     * @return string
     */
    public function getTitle() 
    {
        return $this->title ?? '';
    }




}