<?php

namespace LinkedSwissbibBundle\Entity;

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
     * @var string | array
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/holdingFor")
     */
    private $holdingFor;

    /**
     * @var string | array | array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/page")
     */
    private $page;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/owner")
     */
    private $owner;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/locator")
     */
    private $locator;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/subLocation")
     */
    private $subLocation;

    /**
     * @param array | string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string | array
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array | string $holdingFor
     */
    public function setHoldingFor($holdingFor)
    {
        $this->holdingFor = $holdingFor;
    }

    /**
     * @return string | array
     */
    public function getHoldingFor()
    {
        return $this->holdingFor;
    }

    /**
     * @param array | string $subLocation
     */
    public function setSubLocation($subLocation)
    {
        $this->subLocation = $subLocation;
    }

    /**
     * @return string | array
     */
    public function getSubLocation()
    {
        return $this->subLocation;
    }

    /**
     * @param array | string $locator
     */
    public function setLocator($locator)
    {
        $this->locator = $locator;
    }

    /**
     * @return string | array
     */
    public function getLocator()
    {
        return $this->locator;
    }

    /**
     * @param array | string $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string | array
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param array | string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return string | array
     */
    public function getPage()
    {
        return $this->page;
    }
}
