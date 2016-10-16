<?php

namespace LinkedSwissbibBundle\Serializer\Encoder;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use EasyRdf_Graph;
use EasyRdf_Resource;

class HtmlEncoder implements EncoderInterface
{
    /**
     * Supported format
     */
    const FORMAT = 'html';

    /**
     * @var EasyRdf_Graph
     */
    protected $easyRdfGraph;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * RdfxmlEncoder constructor.
     *
     * @param EasyRdf_Graph $easyRdfGraph
     */
    public function __construct(EasyRdf_Graph $easyRdfGraph, EngineInterface $templating)
    {
        $this->easyRdfGraph = $easyRdfGraph;
        $this->templating = $templating;
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        $this->easyRdfGraph->parse(json_encode($data), 'jsonld');

        return $this->easyRdfGraph->dump('html');
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return self::FORMAT === $format;
    }
}
