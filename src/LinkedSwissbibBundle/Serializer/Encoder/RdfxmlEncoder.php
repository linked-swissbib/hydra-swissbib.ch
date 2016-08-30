<?php

namespace LinkedSwissbibBundle\Serializer\Encoder;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use EasyRdf_Graph;

class RdfxmlEncoder implements EncoderInterface
{
    /**
     * Supported format
     */
    const FORMAT = 'rdf'; //todo find out how to use rdfxml, because rdf is also mapped to application/rdf+xml

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
        $data = [
            "http://xmlns.com/foaf/0.1/Organization" => [
                "http://www.w3.org/1999/02/22-rdf-syntax-ns#/ID" =>  array( array( "type" => "literal" , "value" => "ABN-30iu721838-3954-3cc9-88fe-96f1eb279f1b" ), ),
                "http://www.w3.org/2000/01/rdf-schema#/label" =>  array( array( "type" => "literal" , "value" => "testLabel" ), ),
            ]
        ];
        $this->easyRdfGraph->parse($data, 'php');

        //return '<xml><root>some xml</root>';
        return $this->easyRdfGraph->serialise('rdfxml');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return self::FORMAT === $format;
    }
}
