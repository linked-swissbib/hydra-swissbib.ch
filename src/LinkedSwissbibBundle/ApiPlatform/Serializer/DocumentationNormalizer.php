<?php
namespace LinkedSwissbibBundle\ApiPlatform\Serializer;

use ApiPlatform\Core\Documentation\Documentation;
use ApiPlatform\Core\Hydra\Serializer\DocumentationNormalizer as ApiPlatformDocumentationNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Decorated class DocumentationNormalizer in order to allow all formats
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
     * @param ApiPlatformDocumentationNormalizer $documentationNormalizer
     */
    public function __construct(ApiPlatformDocumentationNormalizer $documentationNormalizer)
    {
        $this->documentationNormalizer = $documentationNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $this->documentationNormalizer->normalize($object, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Documentation && $format !== 'json';
    }
}
