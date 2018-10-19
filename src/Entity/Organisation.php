<?php


namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping\OneToOne;


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
     * @var string|array
     *
     * @ApiProperty(iri="http://www.w3.org/2002/07/owl#",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $sameAs;


    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $homepage;


    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $phone;


    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $mbox;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://www.w3.org/2006/vcard/ns#",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $hasRegion;


    /**
     * Todo: define as vcard and rename to hasAddress that the property mapper can recognize this property
     *
     * @var Address
     *
     * @ApiSubresource
     */
    private $address;


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

    /**
     * @return array|string
     */
    public function getSameAs()
    {
        return $this->sameAs;
    }

    /**
     * @param array|string $sameAs
     */
    public function setSameAs($sameAs)
    {
        $this->sameAs = $sameAs;
    }


    /**
     * @return array|string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @param array|string $sameAs
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    }


    /**
     * @return array|string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param array|string $sameAs
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return array|string
     */
    public function getMbox()
    {
        return $this->mbox;
    }

    /**
     * @param array|string $sameAs
     */
    public function setMbox($mbox)
    {
        $this->mbox = $mbox;
    }

    /**
     * @return array|string
     */
    public function getHasRegion()
    {
        return $this->hasRegion;
    }

    /**
     * @param array|string $sameAs
     */
    public function setHasRegion($hasRegion)
    {
        $this->hasRegion = $hasRegion;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     *
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }



}
