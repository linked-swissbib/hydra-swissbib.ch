<?php

namespace LinkedSwissbibBundle\Serializer;

use ApiPlatform\Core\Api\Entrypoint;
use ApiPlatform\Core\Hydra\Serializer\EntrypointNormalizer as ApiPlatformEntrypointNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Decorated classEntrypointNormalizer in order to allow all formats
 */
class EntrypointNormalizer implements NormalizerInterface
{
    /**
     * @var ApiPlatformEntrypointNormalizer
     */
    protected $entrypointNormalizer;

    /**
     * @param ApiPlatformEntrypointNormalizer $entrypointNormalizer
     */
    public function __construct(ApiPlatformEntrypointNormalizer $entrypointNormalizer)
    {
        $this->entrypointNormalizer = $entrypointNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->entrypointNormalizer->normalize($object, $format, $context);
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Entrypoint;
    }
}
