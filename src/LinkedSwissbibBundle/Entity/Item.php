<?php

namespace LinedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;


/**
 * An Item.
 *
 * @see http://bibframe.org/vocab/HeldItem
 *
 * @ApiResource(
 *     iri="http://bibframe.org/vocab/HeldItem",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class Item
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
     * @ApiProperty(iri="http://bibframe.org/vocab/holdingFor")
     */
    private $holdingFor;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/page")
     */
    private $page;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/owner")
     */
    private $owner;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/locator")
     */
    private $locator;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/subLocation")
     */
    private $subLocation;
    /**
     * @var array
     *
     * @ApiProperty(readable=false)
     */
    private $source;
    /**
     * Item constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->id = $response['_id'];
        $this->holdingFor = $response['_source']['bf:holdingFor'] ?? null;
        $this->subLocation = $response['_source']['bf:subLocation'] ?? null;
        $this->locator = $response['_source']['bibo:locator'] ?? null;
        $this->owner = $response['_source']['bibo:owner'] ?? null;
        $this->page  = $response['_source']['foaf:page'] ?? null;
        $this->source = $response['_source'];
    }

    /**
     * @return
     */
    public function getId() 
    {
        return $this->id ?? '';
    }
    /**
     * @return
     */
    public function getHoldingFor() 
    {
        return $this->holdingFor ?? '';
    }
    /**
     * @return
     */
    public function getSubLocation() 
    {
        return $this->subLocation ?? '';
    }
    /**
     * @return
     */
    public function getLocator() 
    {
        return $this->locator ?? '';
    }
    /**
     * @return
     */
    public function getOwner() 
    {
        return $this->owner ?? '';
    }
    /**
     * @return
     */
    public function getPage() 
    {
        return $this->page ?? '';
    }
}