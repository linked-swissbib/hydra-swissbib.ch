<?php
namespace LinedSwissbibBundle\Entity;

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
     * @ApiProperty(iri="http://bibframe.org/vocab/instanceOf")
     */
    private $instanceOf;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/edition")
     */
    private $edition;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/isbn10")
     */
    private $isbn10;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/isbn13")
     */
    private $isbn13;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/ontology/bibo/issn")
     */
    private $issn;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/originalLanguage")
     */
    private $originalLanguage;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/elements/1.1/format")
     */
    private $format;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/alternative")
     */
    private $alternative;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/bibliographicCitation")
     */
    private $bibliographicCitation;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/contributor")
     */
    private $contributor;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/hasPart")
     */
    private $hasPart;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/isPartOf")
     */
    private $isPartOf;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/issued")
     */
    private $issued;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/language")
     */
    private $language;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/subject")
     */
    private $subject;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://purl.org/dc/terms/title")
     */
    private $title;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60049")
     */
    private $P60049;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60050")
     */
    private $P60050;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60051")
     */
    private $P60051;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60163")
     */
    private $P60163;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60333")
     */
    private $P60333;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60339")
     */
    private $P60339;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60470")
     */
    private $P60470;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60489")
     */
    private $P60489;

    /**
     * @var string
     *
     * @ApiProperty(iri="http://rdaregistry.info/Elements/u/P60163")
     */
    private $type;
    /**
     * @var string
     *
     * @ApiProperty(iri="http://www.w3.org/2000/01/rdf-schema#/idDefinedBy")
     */
    private $isDefinedBy;
    /**
     * @var string
     *
     * @ApiProperty(iri="?")
     */
   //?? private $work;

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
        $this->instanceOf = $response['_source']['bf:instanceOf'] ?? null;
        $this->edition = $response['_source']['bibo:edition'] ?? null;
        $this->isbn10 = $response['_source']['bibo:isbn10'] ?? null;
        $this->isbn13 = $response['_source']['bibo:isbn13'] ?? null;
        $this->issn = $response['_source']['bibo:issn'] ?? null;
        $this->format = $response['_source']['dc:format'] ?? null;
        $this->originalLanguage = $response['_source']['dbp:originalLanguage'] ?? null;
        $this->alternative = $response['_source']['dct:alternative'] ?? null;
        $this->bibliographicCitation = $response['_source']['dct:bibliographicCitation'] ?? null;
        $this->contributor = $response['_source']['dct:contributor'] ?? null;
        $this->hasPart = $response['_source']['dct:hasPart'] ?? null;
        $this->isPartOf = $response['_source']['dct:isPartOf'] ?? null;
        $this->issued = $response['_source']['dct:issued'] ?? null;
        $this->subject = $response['_source']['dct:subject'] ?? null;
        $this->title = $response['_source']['dct:title'] ?? null;
        $this->P60049 = $response['_source']['rdau:P60049'] ?? null;
        $this->P60050 = $response['_source']['rdau:P60050'] ?? null;
        $this->P60051 = $response['_source']['rdau:P60051'] ?? null;
        $this->P60163= $response['_source']['rdau:P60163'] ?? null;
        $this->P60333= $response['_source']['rdau:P60333'] ?? null;
        $this->P60339= $response['_source']['rdau:P60339'] ?? null;
        $this->P60470= $response['_source']['rdau:P60470'] ?? null;
        $this->P60489= $response['_source']['rdau:P60489'] ?? null;
        $this->type= $response['_source']['rdf:type'] ?? null;
        $this->isDefinedBy= $response['_source']['rdfs:isDefinedBy'] ?? null;

        //??  work?

        $this->type = $response['_source']['rdf:type'] ?? null;
        $this->id = $response['_id'];
        $this->source = $response['_source'];
    }
    /**
     * @return
     */
    public function getTitle()  
    {
        return $this->title ?? '';
    }
    /**
     * @return
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
     * @return
     */
    public function getType()  
    {
        return $this->type ?? '';
    }
    /**
     * @return
     */
    public function getLanguage()  
    {
        return $this->language ?? '';
    }
    /**
     * @return
     */
    public function getFormat()  
    {
        return $this->format ?? '';
    }

    /**
     * @return string
     */
    public function getInstanceOf()
    {
        return $this->instanceOf;
    }

    /**
     * @return string
     */
    public function getEdition(): string
    {
        return $this->edition;
    }

    /**
     * @return string
     */
    public function getIsbn10(): string
    {
        return $this->isbn10;
    }

    /**
     * @return string
     */
    public function getIsbn13(): string
    {
        return $this->isbn13;
    }

    /**
     * @return string
     */
    public function getIssn(): string
    {
        return $this->issn;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * @return string
     */
    public function getAlternative(): string
    {
        return $this->alternative;
    }

    /**
     * @return string
     */
    public function getBibliographicCitation(): string
    {
        return $this->bibliographicCitation;
    }

    /**
     * @return string
     */
    public function getContributor(): string
    {
        return $this->contributor;
    }

    /**
     * @return string
     */
    public function getHasPart(): string
    {
        return $this->hasPart;
    }

    /**
     * @return string
     */
    public function getIsPartOf(): string
    {
        return $this->isPartOf;
    }

    /**
     * @return string
     */
    public function getIssued(): string
    {
        return $this->issued;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getP60049(): string
    {
        return $this->P60049;
    }

    /**
     * @return string
     */
    public function getP60050(): string
    {
        return $this->P60050;
    }

    /**
     * @return string
     */
    public function getP60051(): string
    {
        return $this->P60051;
    }

    /**
     * @return string
     */
    public function getP60163(): string
    {
        return $this->P60163;
    }

    /**
     * @return string
     */
    public function getP60333(): string
    {
        return $this->P60333;
    }

    /**
     * @return string
     */
    public function getP60339(): string
    {
        return $this->P60339;
    }

    /**
     * @return string
     */
    public function getP60470(): string
    {
        return $this->P60470;
    }

    /**
     * @return string
     */
    public function getP60489(): string
    {
        return $this->P60489;
    }

    /**
     * @return string
     */
    public function getIsDefinedBy(): string
    {
        return $this->isDefinedBy;
    }


}