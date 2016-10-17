<?php

namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

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
     * @var string|array
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/hasInstance",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $hasInstance;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     *
     */
    private $contributor;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/title",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $title;

    /**
     * @param array|string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string|array
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array|string $hasInstance
     */
    public function setHasInstance($hasInstance)
    {
        $this->hasInstance = $hasInstance;
    }

    /**
     * @return string|array
     */
    public function getHasInstance()
    {
        return $this->hasInstance;
    }

    /**
     * @param array|string $contributor
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * @return string|array
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @param array|string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string|array
     */
    public function getTitle()
    {
        return $this->title;
    }
}
