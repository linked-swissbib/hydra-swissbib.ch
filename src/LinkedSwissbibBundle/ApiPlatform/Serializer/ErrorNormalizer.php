<?php

namespace LinkedSwissbibBundle\ApiPlatform\Serializer;

use ApiPlatform\Core\Hydra\Serializer\ErrorNormalizer as ApiPlatformErrorNormalizer;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Decorated ErrorNormalizer in order to serialize errors to all rdf formats
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
final class ErrorNormalizer implements NormalizerInterface
{
    /**
     * @var ApiPlatformErrorNormalizer
     */
    protected $errorNormlizer;

    /**
     * @param ApiPlatformErrorNormalizer $errorNormalizer
     */
    public function __construct(ApiPlatformErrorNormalizer $errorNormalizer)
    {
        $this->errorNormlizer = $errorNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $this->errorNormlizer->normalize($object, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Exception || $data instanceof FlattenException;
    }
}
