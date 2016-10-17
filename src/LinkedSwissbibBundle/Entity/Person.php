<?php

namespace LinkedSwissbibBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A person.
 *
 * @see ?
 *
 * @ApiResource(
 *     iri="?",
 *     itemOperations={
 *          "get":{"method":"GET"}
 *     },
 *     collectionOperations={
 *          "get":{"method":"GET"}
 *     }
 * )
 */
class Person
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
     * @Assert\Date
     * @ApiProperty(iri="http://dbpedia.org/ontology/birthYear",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#gYear"
     *     }
     * })
     */
    private $birthYear;

    /**
     * @var string|array
     *
     * @Assert\Date
     * @ApiProperty(iri="http://dbpedia.org/ontology/deathYear",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#gYear"
     *     }
     * })
     */
    private $deathYear;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/firstName",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $firstName;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/lastName",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $lastName;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://xmlns.com/foaf/0.1/name",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     *
     */
    private $name;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="https://schema.org/sameAs",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $sameAs;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://www.w3.org/2000/01/rdf-schema#/label",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $label;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://www.w3.org/2004/02/skos/core#/note",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $note;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/birthPlace",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $birthPlace;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/deathPlace",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     *
     */
    private $deathPlace;

    /**
     * @var string|array
     *
     * @Assert\Date
     * @ApiProperty(iri="http://dbpedia.org/ontology/birthDate",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#gYear"
     *     }
     * })
     */
    private $birthDate;

    /**
     * @var string|array
     *
     * @Assert\Date
     * @ApiProperty(iri="http://dbpedia.org/ontology/deathDate",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#gYear"
     *     }
     * })
     */
    private $deathDate;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/genre",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $genre;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/movement",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $movement;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/nationality",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $nationality;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/notableWork",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     *
     */
    private $notableWork;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/occupation",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $occupation;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/thumbnail",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $thumbnail;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/influencedBy",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $influencedBy;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/partner",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $partner;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/pseudonym",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     "@container"="@language"
     *     }
     * })
     */
    private $pseudonym;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/spouse",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $spouse;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/influenced",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $influenced;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="https://schema.org/alternateName",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $alternateName;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="https://schema.org/familyName",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $familyName;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="https://schema.org/givenName",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     }
     * })
     */
    private $givenName;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="https://schema.org/gender",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $gender;

    /**
     * @var string|array
     *
     * @ApiProperty(iri="http://www.w3.org/1999/02/22-rdf-syntax-ns#/type,writable=false",attributes={
     *     "jsonld_context"={
     *     "@type"="@id"
     *     }
     * })
     */
    private $type;
    /**
     * @var string|array
     *
     *
     * @ApiProperty(iri="http://dbpedia.org/ontology/abstract",writable=false,attributes={
     *     "jsonld_context"={
     *     "@type"="http://www.w3.org/2001/XMLSchema#string"
     *     "@container"="@language"
     *     }
     * })
     */
    private $abstract;

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
    public function getBirthYear()
    {
        return $this->birthYear;
    }

    /**
     * @param array|string $birthYear
     */
    public function setBirthYear($birthYear)
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return array|string
     */
    public function getDeathYear()
    {
        return $this->deathYear;
    }

    /**
     * @param array|string $deathYear
     */
    public function setDeathYear($deathYear)
    {
        $this->deathYear = $deathYear;
    }

    /**
     * @return array|string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param array|string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return array|string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param array|string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return array|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array|string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param array|string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return array|string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param array|string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return array|string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * @param array|string $birthPlace
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;
    }

    /**
     * @return array|string
     */
    public function getDeathPlace()
    {
        return $this->deathPlace;
    }

    /**
     * @param array|string $deathPlace
     */
    public function setDeathPlace($deathPlace)
    {
        $this->deathPlace = $deathPlace;
    }

    /**
     * @return array|string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param array|string $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return array|string
     */
    public function getDeathDate()
    {
        return $this->deathDate;
    }

    /**
     * @param array|string $deathDate
     */
    public function setDeathDate($deathDate)
    {
        $this->deathDate = $deathDate;
    }

    /**
     * @return array|string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param array|string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return array|string
     */
    public function getMovement()
    {
        return $this->movement;
    }

    /**
     * @param array|string $movement
     */
    public function setMovement($movement)
    {
        $this->movement = $movement;
    }

    /**
     * @return array|string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param array|string $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * @return array|string
     */
    public function getNotableWork()
    {
        return $this->notableWork;
    }

    /**
     * @param array|string $notableWork
     */
    public function setNotableWork($notableWork)
    {
        $this->notableWork = $notableWork;
    }

    /**
     * @return array|string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param array|string $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    /**
     * @return array|string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param array|string $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return array|string
     */
    public function getInfluencedBy()
    {
        return $this->influencedBy;
    }

    /**
     * @param array|string $influencedBy
     */
    public function setInfluencedBy($influencedBy)
    {
        $this->influencedBy = $influencedBy;
    }

    /**
     * @return array|string
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @param array|string $partner
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return array|string
     */
    public function getPseudonym()
    {
        return $this->pseudonym;
    }

    /**
     * @param array|string $pseudonym
     */
    public function setPseudonym($pseudonym)
    {
        $this->pseudonym = $pseudonym;
    }

    /**
     * @return array|string
     */
    public function getSpouse()
    {
        return $this->spouse;
    }

    /**
     * @param array|string $spouse
     */
    public function setSpouse($spouse)
    {
        $this->spouse = $spouse;
    }

    /**
     * @return array|string
     */
    public function getInfluenced()
    {
        return $this->influenced;
    }

    /**
     * @param array|string $influenced
     */
    public function setInfluenced($influenced)
    {
        $this->influenced = $influenced;
    }

    /**
     * @return array|string
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * @param array|string $alternateName
     */
    public function setAlternateName($alternateName)
    {
        $this->alternateName = $alternateName;
    }

    /**
     * @return array|string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * @param array|string $familyName
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;
    }

    /**
     * @return array|string
     */
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * @param array|string $givenName
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;
    }

    /**
     * @return array|string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param array|string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param array|string $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }
}
