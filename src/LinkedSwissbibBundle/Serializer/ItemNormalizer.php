<?php

namespace LinkedSwissbibBundle\Serializer;

use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\Exception\InvalidArgumentException;
use ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer as ApiPlatformItemNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\scalar;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Decorated ItemNormalizer in order to be able to exclude null values and use json-ld as input format for all encoders
 *
 * @author   Melanie Stucki <melanie.stucki@students.fhnw.ch>, Markus Mächler <markus.maechler@students.fhnw.ch>
 * @license  http://opensource.org/licenses/gpl-2.0.php
 * @link     http://linked.swissbib.ch
 */
class ItemNormalizer implements SerializerAwareInterface, NormalizerInterface, DenormalizerInterface
{
    /**
     * @var ApiPlatformItemNormalizer
     */
    protected $itemNormalizer;

    /**
     * @var ResourceClassResolverInterface
     */
    protected $resourceClassResolver;

    /**
     * @param ApiPlatformItemNormalizer $itemNormalizer
     * @param ResourceClassResolverInterface $resourceClassResolver
     */
    public function __construct(ApiPlatformItemNormalizer $itemNormalizer, ResourceClassResolverInterface $resourceClassResolver)
    {
        $this->itemNormalizer = $itemNormalizer;
        $this->resourceClassResolver = $resourceClassResolver;
    }

    /**
     * Sets the owning Serializer object.
     *
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->itemNormalizer->setSerializer($serializer);
    }

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    data to restore
     * @param string $class   the expected class to instantiate
     * @param string $format  format the given data was extracted from
     * @param array  $context options available to the denormalizer
     *
     * @return object
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        return $this->itemNormalizer->denormalize($data, $class, $format, $context);
    }

    /**
     * Checks whether the given class is supported for denormalization by this normalizer.
     *
     * @param mixed  $data   Data to denormalize from
     * @param string $type   The class to which the data should be denormalized
     * @param string $format The format being deserialized from
     *
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->itemNormalizer->supportsDenormalization($data, $type, $format);
    }

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param object $object  object to normalize
     * @param string $format  format the normalization result will be encoded as
     * @param array  $context Context options for the normalizer
     *
     * @return array|scalar
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if ($format !== ApiPlatformItemNormalizer::FORMAT) {
            //embed context to avoid an additional request on encoding to e.g. rdf
            $context['jsonld_embed_context'] = true;
        }

        $normalizedData = $this->itemNormalizer->normalize($object, $format, $context);
        $filteredData = $this->filterNullValues($normalizedData);

        return $filteredData;
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed  $data   Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        if (!is_object($data)) {
            return false;
        }

        try {
            $this->resourceClassResolver->getResourceClass($data);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function filterNullValues(array $data)
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }
}
