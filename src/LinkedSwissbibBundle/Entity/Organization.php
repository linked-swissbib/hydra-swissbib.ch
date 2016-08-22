<?php


namespace LinedSwissbibBundle\Entity;


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
     * @var string
     *
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://www.w3.org/2000/01/rdf-schema#/label")
     */
    private $label;

    /**
     * @var array
     *
     * @ApiProperty(readable=false)
     */
    private $source;
    /**
     * Origanizationn constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->id = $response['_id'];
        $this->label = $response['_source']['rdfs:label'] ?? null;
        $this->source = $response['_source'];
    }

    /**
     * @return string
     */
    public function getId() 
    {
        return $this->id ?? '';
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
    public function getLabel() 
    {
        return $this->label ?? '';
    }
}

