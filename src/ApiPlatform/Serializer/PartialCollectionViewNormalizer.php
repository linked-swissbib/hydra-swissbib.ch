<?php

namespace LinkedSwissbibBundle\ApiPlatform\Serializer;

use ApiPlatform\Core\Hydra\Serializer\PartialCollectionViewNormalizer as ApiPlatformPartialCollectionViewNormalizer;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Decorated PartialCollectionViewNormalizer in order to allow absolute urls
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class PartialCollectionViewNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    /**
     * @var ApiPlatformPartialCollectionViewNormalizer
     */
    protected $partialCollectionViewNormalizer;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @param ApiPlatformPartialCollectionViewNormalizer $partialCollectionViewNormalizer
     * @param RequestStack $requestStack
     */
    public function __construct(ApiPlatformPartialCollectionViewNormalizer $partialCollectionViewNormalizer, RequestStack $requestStack)
    {
        $this->partialCollectionViewNormalizer = $partialCollectionViewNormalizer;
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = $this->partialCollectionViewNormalizer->normalize($object, $format, $context);

        if (isset($data['hydra:view'])) {
            $baselUrl = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();

            if (isset($data['hydra:view']['@id'])) {
                $data['hydra:view']['@id'] = $baselUrl . $data['hydra:view']['@id'];
            }

            if (isset($data['hydra:view']['hydra:first'])) {
                $data['hydra:view']['hydra:first'] = $baselUrl . $data['hydra:view']['hydra:first'];
            }

            if (isset($data['hydra:view']['hydra:last'])) {
                $data['hydra:view']['hydra:last'] = $baselUrl . $data['hydra:view']['hydra:last'];
            }

            if (isset($data['hydra:view']['hydra:previous'])) {
                $data['hydra:view']['hydra:previous'] = $baselUrl . $data['hydra:view']['hydra:previous'];
            }

            if (isset($data['hydra:view']['hydra:next'])) {
                $data['hydra:view']['hydra:next'] = $baselUrl . $data['hydra:view']['hydra:next'];
            }
        }

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->partialCollectionViewNormalizer->supportsNormalization($data, $format);
    }

    /**
     * @inheritdoc
     */
    public function setNormalizer(NormalizerInterface $normalizer)
    {
        $this->partialCollectionViewNormalizer->setNormalizer($normalizer);
    }
}
