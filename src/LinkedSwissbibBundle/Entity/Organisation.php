<?php


namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * he Organization class represents a kind of Agent corresponding to social instititutions such as companies, societies etc.
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
 *     },
 *     attributes={
 *          "filters"={"linked_swissbib.fieldsqueryfilter"}
 *     }
 * )
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class Organisation
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
     * @ApiProperty(iri="http://www.w3.org/2000/01/rdf-schema#/label",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $label;

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
     * @param array|string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    /**
     * @return string|array
     */
    public function getLabel()
    {
        return $this->label;
    }
}
