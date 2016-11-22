<?php
namespace LinkedSwissbibBundle\ApiPlatform\Serializer;

use ApiPlatform\Core\Hydra\Serializer\ConstraintViolationListNormalizer as ApiPlatformConstraintViolationListNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Decorated class ConstraintViolationListNormalizer in order to allow all formats
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
final class ConstraintViolationListNormalizer implements NormalizerInterface
{
    /**
     * @var ApiPlatformConstraintViolationListNormalizer
     */
    protected $constraintViolationListNormalizer;

    /**
     * @param ApiPlatformConstraintViolationListNormalizer $constraintViolationListNormalizer
     */
    public function __construct(ApiPlatformConstraintViolationListNormalizer $constraintViolationListNormalizer)
    {
        $this->constraintViolationListNormalizer = $constraintViolationListNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return $this->constraintViolationListNormalizer->normalize($object, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ConstraintViolationListInterface;
    }
}
