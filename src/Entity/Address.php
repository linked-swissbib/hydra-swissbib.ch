<?php

/**
 * Address
 *
 * PHP version 5
 *
 * Copyright (C) project swissbib, University Library Basel, Switzerland
 * http://www.swissbib.org  / http://www.swissbib.ch / http://www.ub.unibas.ch
 *
 * Date: 23.09.18
 * Time: 12:59
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 2,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @category Swissbib_VuFind2
 * @package  LinkedSwissbibBundle_Entity
 * @author   Günter Hipler <guenter.hipler@unibas.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License
 * @link     http://www.swissbib.org
 */

namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\Entity;


/**
 * An Address
 *@see https://www.w3.org/2006/vcard/ns#
 * @ApiResource(
 *     iri="http://purl.org/ontology/bibo/document",
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
 * @author   Günter Hipler <guenter.hipler@unibas.ch>>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class Address
{


    /**
     * @var string
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/local",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $streetaddress;



    /**
     * @var string
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/local",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $postalcode;


    /**
     * @var string
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/local",writable=false,attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $locality;


    /**
     * @var string
     *
     * @ApiProperty(iri="http://bibframe.org/vocab/local",writable=false,attributes={
     * })
     */
    private $region;

    /**
     * @return string
     */
    public function getStreetaddress(): string
    {
        return $this->streetaddress;
    }

    /**
     * @param string $streetaddress
     *
     */
    public function setStreetaddress($streetaddress)
    {
        $this->streetaddress = $streetaddress;
    }

    /**
     * @return string
     */
    public function getPostalcode(): string
    {
        return $this->postalcode;
    }

    /**
     * @param string $postalcode
     *
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;
    }

    /**
     * @return string
     */
    public function getLocality(): string
    {
        return $this->locality;
    }

    /**
     * @param string $locality
     *
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     *
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }





}