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
     * @ApiProperty(iri="http://bibframe.org/vocab/instanceOf",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $instanceOf;

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
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/edition",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $edition;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/isbn10",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $isbn10;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/isbn13",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $isbn13;
    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/issn",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $issn;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/originalLanguage",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $originalLanguage;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/alternative",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $alternative;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/bibliographicCitation",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $bibliographicCitation;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $contributor;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/hasPart",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $hasPart;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/isPartOf",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $isPartOf;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/issued",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $issued;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/subject",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $subject;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60049",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $P60049;
    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60050",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $P60050;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60051",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $P60051;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60163",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $P60163;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60333",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $P60333;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60339",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $P60339;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60470",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $P60470;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60489",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $P60489;


    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://www.w3.org/2000/01/rdf-schema#/idDefinedBy",writable=false, attributes={
     *     "jsonld_context"={
     *         "@type"="@id"
     *     }
     * })
     */
    private $isDefinedBy;

    /**
     * @return array|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array|string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param array|string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param array|string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param array|string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return array|string
     */
    public function getInstanceOf()
    {
        return $this->instanceOf;
    }

    /**
     * @param array|string $instanceOf
     */
    public function setInstanceOf($instanceOf)
    {
        $this->instanceOf = $instanceOf;
    }

    /**
     * @return array|string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param array|string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return array|string
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param array|string $edition
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;
    }

    /**
     * @return array|string
     */
    public function getIsbn10()
    {
        return $this->isbn10;
    }

    /**
     * @param array|string $isbn10
     */
    public function setIsbn10($isbn10)
    {
        $this->isbn10 = $isbn10;
    }

    /**
     * @return array|string
     */
    public function getIsbn13()
    {
        return $this->isbn13;
    }

    /**
     * @param array|string $isbn13
     */
    public function setIsbn13($isbn13)
    {
        $this->isbn13 = $isbn13;
    }

    /**
     * @return array|string
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * @param array|string $issn
     */
    public function setIssn($issn)
    {
        $this->issn = $issn;
    }

    /**
     * @return array|string
     */
    public function getOriginalLanguage()
    {
        return $this->originalLanguage;
    }

    /**
     * @param array|string $originalLanguage
     */
    public function setOriginalLanguage($originalLanguage)
    {
        $this->originalLanguage = $originalLanguage;
    }

    /**
     * @return array|string
     */
    public function getAlternative()
    {
        return $this->alternative;
    }

    /**
     * @param array|string $alternative
     */
    public function setAlternative($alternative)
    {
        $this->alternative = $alternative;
    }

    /**
     * @return array|string
     */
    public function getBibliographicCitation()
    {
        return $this->bibliographicCitation;
    }

    /**
     * @param array|string $bibliographicCitation
     */
    public function setBibliographicCitation($bibliographicCitation)
    {
        $this->bibliographicCitation = $bibliographicCitation;
    }

    /**
     * @return array|string
     */
    public function getContributor()
    {
        return $this->contributor;
    }

    /**
     * @param array|string $contributor
     */
    public function setContributor($contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * @return array|string
     */
    public function getHasPart()
    {
        return $this->hasPart;
    }

    /**
     * @param array|string $hasPart
     */
    public function setHasPart($hasPart)
    {
        $this->hasPart = $hasPart;
    }

    /**
     * @return array|string
     */
    public function getIsPartOf()
    {
        return $this->isPartOf;
    }

    /**
     * @param array|string $isPartOf
     */
    public function setIsPartOf($isPartOf)
    {
        $this->isPartOf = $isPartOf;
    }

    /**
     * @return array|string
     */
    public function getIssued()
    {
        return $this->issued;
    }

    /**
     * @param array|string $issued
     */
    public function setIssued($issued)
    {
        $this->issued = $issued;
    }

    /**
     * @return array|string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param array|string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return array|string
     */
    public function getP60049()
    {
        return $this->P60049;
    }

    /**
     * @param array|string $P60049
     */
    public function setP60049($P60049)
    {
        $this->P60049 = $P60049;
    }

    /**
     * @return array|string
     */
    public function getP60050()
    {
        return $this->P60050;
    }

    /**
     * @param array|string $P60050
     */
    public function setP60050($P60050)
    {
        $this->P60050 = $P60050;
    }

    /**
     * @return array|string
     */
    public function getP60051()
    {
        return $this->P60051;
    }

    /**
     * @param array|string $P60051
     */
    public function setP60051($P60051)
    {
        $this->P60051 = $P60051;
    }

    /**
     * @return array|string
     */
    public function getP60163()
    {
        return $this->P60163;
    }

    /**
     * @param array|string $P60163
     */
    public function setP60163($P60163)
    {
        $this->P60163 = $P60163;
    }

    /**
     * @return array|string
     */
    public function getP60333()
    {
        return $this->P60333;
    }

    /**
     * @param array|string $P60333
     */
    public function setP60333($P60333)
    {
        $this->P60333 = $P60333;
    }

    /**
     * @return array|string
     */
    public function getP60339()
    {
        return $this->P60339;
    }

    /**
     * @param array|string $P60339
     */
    public function setP60339($P60339)
    {
        $this->P60339 = $P60339;
    }

    /**
     * @return array|string
     */
    public function getP60470()
    {
        return $this->P60470;
    }

    /**
     * @param array|string $P60470
     */
    public function setP60470($P60470)
    {
        $this->P60470 = $P60470;
    }

    /**
     * @return array|string
     */
    public function getP60489()
    {
        return $this->P60489;
    }

    /**
     * @param array|string $P60489
     */
    public function setP60489($P60489)
    {
        $this->P60489 = $P60489;
    }

    /**
     * @return array|string
     */
    public function getIsDefinedBy()
    {
        return $this->isDefinedBy;
    }

    /**
     * @param array|string $isDefinedBy
     */
    public function setIsDefinedBy($isDefinedBy)
    {
        $this->isDefinedBy = $isDefinedBy;
    }
}
