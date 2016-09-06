<?php

namespace LinkedSwissbibBundle\Serializer\Encoder;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use EasyRdf_Graph;

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
        //TODO find out how to generate fully qualified context and id urls OR better embed context
        $data['@context'] = 'http://' . $_SERVER['HTTP_HOST'] . $data['@context'];
        $data['@id'] = 'http://' . $_SERVER['HTTP_HOST'] . $data['@id'];

        return $this->templating->render(
            'concept.html.twig',
            [
                'data' => $data
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format)
    {
        return self::FORMAT === $format;
    }
}
