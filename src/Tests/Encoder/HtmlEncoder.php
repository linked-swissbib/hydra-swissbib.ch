<?php

namespace LinkedSwissbibBundle\Tests\Encoder;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

/**
 * HtmlEncoder
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class HtmlEncoder extends \LinkedSwissbibBundle\Serializer\Encoder\HtmlEncoder
{
    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        return $this->templating->render(
            'concept.test.html.twig',
            [
                'data' => $data
            ]
        );
    }
}
