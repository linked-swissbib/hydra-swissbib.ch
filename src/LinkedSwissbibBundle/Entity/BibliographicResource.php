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
     * BibliographicResource constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->title = $response['_source']['dct:title'] ?? null;
        $this->type = $response['_source']['rdf:type'] ?? null;
        $this->language = $response['_source']['dct:language'] ?? null;
        $this->format = $response['_source']['dc:format'] ?? null;
        $this->id = $response['_id'];
    }
    
    /**
     * @return string | array
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @return string | array
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string |array
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @return string | array
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string | array
     */
    public function getFormat()
    {
        return $this->format;
    }
}
