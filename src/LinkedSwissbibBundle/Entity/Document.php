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
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class Document
{
    /**
     * @var string|array identifier of a document
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/local",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $local;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $contributor;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/issued",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#dateTime"
     *     }
     * })
     */
    private $issued;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/modified",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#dateTime"
     *     }
     * })
     */
    private $modified;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/primaryTopic",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $primaryTopic;

    /**
     * @return array|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array|string/ $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array|string/
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param array|string/ $local
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    /**
     * @return array|string/
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @param array|string/ $contributor
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * @return array|string/
     */
    public function getIssued()
    {
        return $this->issued;
    }

    /**
     * @param array|string/ $issued
     */
    public function setIssued($issued)
    {
        $this->issued = $issued;
    }

    /**
     * @return array|string/
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param array|string/ $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return array|string
     */
    public function getPrimaryTopic()
    {
        return $this->primaryTopic;
    }

    /**
     * @param array|string/ $primaryTopic
     */
    public function setPrimaryTopic($primaryTopic)
    {
        $this->primaryTopic = $primaryTopic;
    }
}
