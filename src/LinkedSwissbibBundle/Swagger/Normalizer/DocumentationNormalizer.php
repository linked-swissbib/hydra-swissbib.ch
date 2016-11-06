<?php

namespace LinkedSwissbibBundle\Swagger\Normalizer;

use ApiPlatform\Core\Api\UrlGeneratorInterface;
use ApiPlatform\Core\Documentation\Documentation;
use ApiPlatform\Core\Swagger\Serializer\DocumentationNormalizer as ApiPlatformDocumentationNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Decorated DocumentationNormalizer in order to overwrite basePath. We have "hard coded" absolute urls by decorating the router.
 * For the swagger ui to work correctly it needs a relative base path url.
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class DocumentationNormalizer implements NormalizerInterface
{
    /**
     * @var ApiPlatformDocumentationNormalizer
     */
    protected $documentationNormalizer;

    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * @param ApiPlatformDocumentationNormalizer $documentationNormalizer
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(ApiPlatformDocumentationNormalizer $documentationNormalizer, UrlGeneratorInterface $urlGenerator)
    {
        $this->documentationNormalizer = $documentationNormalizer;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $doc = $this->documentationNormalizer->normalize($object, $format, $context);

        $doc['basePath'] =  $this->urlGenerator->generate('api_entrypoint', ['_dont_force_reference_type' => true]);

        return $doc;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return ApiPlatformDocumentationNormalizer::FORMAT === $format && $data instanceof Documentation;
    }
}
