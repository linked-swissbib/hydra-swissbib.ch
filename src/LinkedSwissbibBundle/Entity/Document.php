<?php
namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Document.
 *
 * @see http://purl.org/ontology/bibo/document
 *
 * @ApiResource(
 *     iri="http://purl.org/ontology/bibo/document",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class Document
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
     * @ApiProperty(iri="http://bibframe.org/vocab/local");
     *
     */
    private $local;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor");
     *
     */
    private $contributor;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/issued");
     *
     */
    private $issued;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/modified");
     *
     */
    private $modified;

    /**
     * @var string | array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/primaryTopic");
     *
     */
    private $primaryTopic;

    /**
     * @return array | string/
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array | string/ $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array | string/
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param array | string/ $local
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    /**
     * @return array | string/
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @param array | string/ $contributor
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * @return array | string/
     */
    public function getIssued()
    {
        return $this->issued;
    }

    /**
     * @param array | string/ $issued
     */
    public function setIssued($issued)
    {
        $this->issued = $issued;
    }

    /**
     * @return array | string/
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param array | string/ $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return array | string
     */
    public function getPrimaryTopic()
    {
        return $this->primaryTopic;
    }

    /**
     * @param array | string/ $primaryTopic
     */
    public function setPrimaryTopic($primaryTopic)
    {
        $this->primaryTopic = $primaryTopic;
    }
}
