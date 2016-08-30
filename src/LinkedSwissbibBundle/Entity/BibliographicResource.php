<?php

namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A BibliographicResource.
 *
 * @see http://purl.org/dc/terms/BibliographicResource Documentation on purl.org
 *
 * @ApiResource(
 *     iri="http://purl.org/dc/terms/BibliographicResource",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class BibliographicResource
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
     * @ApiProperty(iri="http://purl.org/dc/terms/title")
     */
    private $title;
    
    /**
     * @var string | array
     *
     * @ApiProperty(iri="https://www.w3.org/1999/02/22-rdf-syntax-ns#type")
     */
    private $type;
    
    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/language")
     */
    private $language;
    
    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/elements/1.1/format")
     */
    private $format;

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
     * @param array | string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string | array
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param array | string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string |array
    */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array | string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * @return string | array
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param array | string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string | array
     */
    public function getFormat()
    {
        return $this->format;
    }
}
