<?php

namespace LinkedSwissbibBundle\ApiPlatform\Serializer;

use ApiPlatform\Core\Hydra\Serializer\CollectionFiltersNormalizer as ApiPlatformCollectionFiltersNormalizer;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Decorated CollectionFiltersNormalizer in order to allow absolute urls
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class CollectionFiltersNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    /**
     * @var ApiPlatformCollectionFiltersNormalizer
     */
    protected $collectionFiltersNormalizer;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @param ApiPlatformCollectionFiltersNormalizer $collectionFiltersNormalizer
     * @param RequestStack $requestStack
     */
    public function __construct(ApiPlatformCollectionFiltersNormalizer $collectionFiltersNormalizer, RequestStack $requestStack)
    {
        $this->collectionFiltersNormalizer = $collectionFiltersNormalizer;
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = $this->collectionFiltersNormalizer->normalize($object, $format, $context);

        if (isset($data['hydra:search'])) {
            $baselUrl = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();

            if (isset($data['hydra:search']['hydra:template'])) {
                $data['hydra:search']['hydra:template'] = $baselUrl . $data['hydra:search']['hydra:template'];
            }
        }

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->collectionFiltersNormalizer->supportsNormalization($data, $format);
    }

    /**
     * @inheritdoc
     */
    public function setNormalizer(NormalizerInterface $normalizer)
    {
        $this->collectionFiltersNormalizer->setNormalizer($normalizer);
    }
}
