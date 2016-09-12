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

        //todo remove after https://github.com/api-platform/api-platform/issues/128 is implemented
        if (isset($_SERVER['HTTP_HOST'])) {
            $data['@context'] = 'http://' . $_SERVER['HTTP_HOST']  . $data['@context'];
        }

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
