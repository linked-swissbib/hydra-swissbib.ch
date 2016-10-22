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
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class BibliographicResource
{
    /**
     * @var string|array Identifier of a bibliographic resource
     *
     * @ApiProperty(identifier=true)
     */
    private $id;
    
    /**
     * @var string|array Title of a bibliographic resource
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/title",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $title;
    
    /**
     * @var string|array
     *
     * @ApiProperty(iri="https://www.w3.org/1999/02/22-rdf-syntax-ns#type",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $type;
    
    /**
     * @var string|array Written language of the bibliographic resource
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/language",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $language;
    
    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/elements/1.1/format",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $format;

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

    /**
     * @param array|string $type
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
     * @param array|string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * @return string|array
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param array|string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string|array
     */
    public function getFormat()
    {
        return $this->format;
    }
}
