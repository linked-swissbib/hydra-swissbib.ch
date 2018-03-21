<?php

namespace LinkedSwissbibBundle\Elasticsearch;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client;
use LinkedSwissbibBundle\ContextMapping\ContextMapper as ContextMapperInterface;

/**
 * ElasticsearchContextMapper
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ContextMapper implements ContextMapperInterface
{

    private $tempInternalToExternal = [
        'LinkedSwissbibBundle\Entity\Item' => [
            'holdingfor' => 'bf:holdingFor',
            'sublocation' => 'bf:subLocation',
            'locator'       => 'bibo:locator',
            'owner'         => 'bibo:owner',
            'page'          => 'foaf:page'

        ],
        'LinkedSwissbibBundle\Entity\BibliographicResource' => [
            //"id" =>  "string",
            "title" => "dct:title",
            //"type"  => "string",
            "language" => "dct:language",
            "instanceof" => "bf:instanceOf",
            "format"    => "dc:format",
            "edition"   => "bibo:edition",
            "isbn10"    => "bibo:isbn10",
            "isbn13"    => "bibo:isbn13",
            "issn"  =>  "bibo:issn",
            "originallanguage"  =>  "dbp:originalLanguage",
            "alternative"   => "dct:alternative",
            "bibliographiccitation" => "dct:bibliographicCitation",
            "contributor"   => "dct:contributor",
            "haspart"   => "dct:hasPart",
            "ispartof"  => "dct:isPartOf",
            "issued"    => "dct:issued",
            "subject"   => "dct:subject",
            "p60049"    => "rdau:P60049",
            "p60050"    =>  "rdau:P60050",
            "p60051"    => "rdau:P60051",
            "p60163"    => "rdau:P60163",
            "p60333"    => "rdau:P60333",
            "p60339"    => "rdau:P60339",
            "p60470"    => "rdau:P60470",
            "p60489"    => "rdau:P60489",
            "isdefinedby"   => "rdfs:isDefinedBy"

        ],
        'LinkedSwissbibBundle\Entity\Document' => [
            'local' => 'bf:local',
            'contributor'   => 'dct:contributor',
            'issued'        =>  'dct:issued',
            'modified'      =>  'dct:modified',
            'primarytopic'  =>  'foaf:primaryTopic'

        ],
        'LinkedSwissbibBundle\Entity\Organisation' => [
            'label' =>  'rdfs:label',
            'owl:sameas'    =>  'owl:sameAs',
            'homepage'  =>  'foaf:homepage',
            'phone' =>  'foaf:phone',
            'mbox'  =>  'foaf:mbox',
            'hasregion' =>  'vcard:hasAddress.vcard:hasRegion'

        ],
        'LinkedSwissbibBundle\Entity\Person' => [
            'birthyear' =>  'dbp:birthYear',
            'deathyear' =>  'dbp:deathDate',
            'firstname' =>  'foaf:firstName',
            'lastname'  =>  'foaf:lastName',
            'name'  =>  'foaf:name',
            'sameas'    =>  'owl:sameAs',
            'label' =>  'rdfs:label',
            'note'  =>  'skos:note',
            'birthplace'    =>  'dbp:birthPlace',
            'deathplace'    =>  'dbp:deathPlace',
            'birthdate' =>  'dbp:birthDate',
            'deathdate' =>  'dbp:deathDate',
            'genre' =>  'dbp:genre',
            'movement'  =>  'dbp:movement',
            'natinality'    =>  'dbp:nationality',
            'notablework'   =>  'dbp:notableWork',
            'occupation'    =>  'dbp:occupation',
            'thumbnail' =>  'dbp:thumbnail',
            'influencedby'  =>  'dbp:influencedBy',
            'partner'   =>  'dbp:partner',
            'pseudonym' =>  'dbp:pseudonym',
            'spouse'    =>  'dbp:spouse',
            'influenced'    =>  'dbp:influenced:',
            'alternatename' =>  'schema:alternateName',
            'familyname'    =>  'schema:familyName',
            'givenname' =>  'schema:givenName',
            'gender'    =>  'schema:gender',
            'abstract'  =>  'dbp:abstract'



        ],
        'LinkedSwissbibBundle\Entity\Work' => [

        ]
    ];



    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var PropertyMetadataFactoryInterface
     */
    protected $propertyMetadataFactory;

    /**
     * @var PropertyNameCollectionFactoryInterface
     */
    protected $propertyNameCollectionFactory;

    /**
     * @var ResourceNameConverter
     */
    protected $resourceNameConverter;

    /**
     * @param Cache $cache
     * @param Client $client
     * @param array $config
     * @param ResourceNameConverter $resourceNameConverter
     * @param PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory
     * @param PropertyMetadataFactoryInterface $propertyMetadataFactory
     */
    public function __construct(Cache $cache, Client $client, array $config, ResourceNameConverter $resourceNameConverter, PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory, PropertyMetadataFactoryInterface $propertyMetadataFactory)
    {
        $this->cache = $cache;
        $this->client = $client;
        $this->config = $config;
        $this->resourceNameConverter = $resourceNameConverter;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function fromInternalToExternal(string $resourceClass, array $internal) : array
    {
        $mapping = $this->loadCachedMapping($resourceClass);
        $mappedValues = [];

        foreach ($internal as $property) {
            $mappedValues[] = $this->tempInternalToExternal[$resourceClass][strtolower($property)];
            #$mappedValues[] = $mapping['internal_to_external'][strtolower( $property)] ?? $property;
        }

        return $mappedValues;
    }

    /**
     * {@inheritdoc}
     */
    public function fromExternalToInternal(string $resourceClass, array $external) : array
    {
        $mapping = $this->loadCachedMapping($resourceClass);
        $mappedValues = [];

        foreach ($external as $hits) {
            $entity = [];

            foreach ($hits['_source'] as $propertyKey => $propertyValue) {
                if (strpos($propertyKey, '@') === false && isset($mapping['external_to_internal'][strtolower($propertyKey)])) {
                    //$internalPropertyName = $this->tempInternalToExternal[$resourceClass][$propertyKey];
                    $internalPropertyName = $mapping['external_to_internal'][strtolower($propertyKey)];
                    $entity[$internalPropertyName] = $hits['_source'][$propertyKey];
                }
            }

            $entity['id'] = $hits['_id'];
            $mappedValues[] = $entity;
        }

        return $mappedValues;
    }

    /**
     * @param string $type
     *
     * @return array
     */
    protected function loadRemoteContext(string $type) : array
    {
        //todo: Remove when we have decided whether its resource or bibliographicResource
        if ($type === 'bibliographicResource') {
            $type = 'resource';
        }

        $url = str_replace('{type}', $type, $this->config['template_url']);

        $response = $this->client->get($url);
        $body = $response->getBody();

        return json_decode($body, true);
    }

    /**
     * @param string $resourceClass
     *
     * @return array
     */
    protected function loadCachedMapping(string $resourceClass) : array
    {
        $cacheKey = 'elasticsearch_context_mapper.' . $resourceClass;

        if ($this->cache->contains($cacheKey)) {
            return $this->cache->fetch($cacheKey);
        }

        $type = $this->resourceNameConverter->getElasticsearchTypeFromResourceClass($resourceClass);
        $remoteContext = $this->loadRemoteContext($type);
        $propertyNames = $this->propertyNameCollectionFactory->create($resourceClass);
        $remoteNamespaces = [];
        $mapping = [
            'internal_to_external' => [],
            'external_to_internal' => [],
        ];

        foreach ($remoteContext['@context'] as $propertyKey => $propertyValue) {
            if (strpos($propertyKey, ':') === false) {
                $remoteNamespaces[$propertyKey] = $propertyValue;
            }
        }

        foreach ($propertyNames as $propertyName) {
            $propertyMetaData = $this->propertyMetadataFactory->create($resourceClass, $propertyName);
            $iri = $propertyMetaData->getIri();

            foreach ($remoteNamespaces as $prefix => $namespace) {
                if (substr($iri, 0, strlen($namespace)) === $namespace) {
                    $remoteName = $prefix . ':' . $propertyName;
                    //todo: evaluate possibilities for mapping
                    //I changed some variable names in BibliographicResource entity to lower case
                    //to implement the mapping
                    $mapping['internal_to_external'][strtolower($propertyName)] = strtolower($remoteName);
                    $mapping['external_to_internal'][strtolower($remoteName)] = strtolower($propertyName);
                }
            }
        }

        $this->cache->save($cacheKey, $mapping);

        return $mapping;
    }
}
