<?php

namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A BiobligraphicResource.
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
     * @var string
     *
     * @ApiProperty(identifier=true)
     */
    private $id;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/title")
     */
    private $title;
    /**
     * @var string
     *
     * @ApiProperty(iri="https://www.w3.org/1999/02/22-rdf-syntax-ns#type")
     */
    private $type;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/language")
     */
    private $language;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/elements/1.1/format")
     */
    private $format;
    /**
     * @var array
     *
     * @ApiProperty(readable=false)
     */
    private $source;
    /**
     * BiobligraphicResource constructor.
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
        $this->source = $response['_source'];
    }
    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title ?? '';
    }
    /**
     * @param string $title
     *
     * @return string
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id ?? '';
    }
    /**
     * @param string $id
     *
     * @return string
     */
    public function setId(string $id)
    {
        $this->id = $id;
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
    public function getType() : string
    {
        return $this->type ?? '';
    }
    /**
     * @param string $type
     *
     * @return string
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
    /**
     * @return string
     */
    public function getLanguage() : string
    {
        return $this->language ?? '';
    }
    /**
     * @param string $language
     *
     * @return string
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }
    /**
     * @return string
     */
    public function getFormat() : string
    {
        return $this->format ?? '';
    }
    /**
     * @param string $format
     *
     * @return string
     */
    public function setFormat(string $format)
    {
        $this->format = $format;
    }
}