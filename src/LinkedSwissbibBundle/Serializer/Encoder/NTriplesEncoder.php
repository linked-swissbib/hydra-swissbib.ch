<?php

namespace LinkedSwissbibBundle\Serializer\Encoder;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use EasyRdf_Graph;

class NTriplesEncoder implements EncoderInterface
{
    /**
     * Supported format
     */
    const FORMAT = 'ntriples'; //TODO find out how to use rdfxml, because rdf is also mapped to application/rdf+xml

    /**
     * @var EasyRdf_Graph
     */
    protected $easyRdfGraph;

    /**
     * RdfxmlEncoder constructor.
     *
     * @param EasyRdf_Graph $easyRdfGraph
     */
    public function __construct(EasyRdf_Graph $easyRdfGraph)
    {
        $this->easyRdfGraph = $easyRdfGraph;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        //TODO find out how to generate fully qualified context and id urls OR better embed context
        $data['@context'] = 'http://' . $_SERVER['HTTP_HOST'] . $data['@context'];
        $data['@id'] = 'http://' . $_SERVER['HTTP_HOST'] . $data['@id'];

        $this->easyRdfGraph->parse(json_encode($data), 'jsonld');

        return $this->easyRdfGraph->serialise('ntriples');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return self::FORMAT === $format;
    }
}
