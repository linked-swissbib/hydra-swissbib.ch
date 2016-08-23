<?php


namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An organization such as a school, NGO, corporation, club, etc.
 *
 * @see http://xmlns.com/foaf/0.1/Organization
 *
 * @ApiResource(
 *     iri="http://xmlns.com/foaf/0.1/Organization",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class Organization
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
     * @ApiProperty(iri="http://www.w3.org/2000/01/rdf-schema#/label")
     */
    private $label;
    
    /**
     * Origanization constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->id = $response['_id'];
        $this->label = $response['_source']['rdfs:label'] ?? null;
    }

    /**
     * @return string | array
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string | array
     */
    public function getLabel()
    {
        return $this->label;
    }
}
