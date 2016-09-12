<?php

namespace LinkedSwissbibBundle\Serializer;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\Api\UrlGeneratorInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
use ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer as ApiPlatformItemNormalizer;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\scalar;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Decorated ItemNormalizer in order to be able to exclude null values and use json-ld as input format for all encoders
 */
class ItemNormalizer extends AbstractItemNormalizer
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
     * @var ResourceMetadataFactoryInterface
     */
    protected $resourceMetadataFactory;

    /**
     * @var ContextBuilderInterface
     */
    protected $contextBuilder;

    /**
     * @param ApiPlatformItemNormalizer $itemNormalizer
     * @param ResourceMetadataFactoryInterface $resourceMetadataFactory
     * @param PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory
     * @param PropertyMetadataFactoryInterface $propertyMetadataFactory
     * @param IriConverterInterface $iriConverter
     * @param ResourceClassResolverInterface $resourceClassResolver
     * @param ContextBuilderInterface $contextBuilder
     * @param PropertyAccessorInterface|null $propertyAccessor
     * @param NameConverterInterface|null $nameConverter
     */
    public function __construct(ApiPlatformItemNormalizer $itemNormalizer, ResourceMetadataFactoryInterface $resourceMetadataFactory, PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory, PropertyMetadataFactoryInterface $propertyMetadataFactory, IriConverterInterface $iriConverter, ResourceClassResolverInterface $resourceClassResolver, ContextBuilderInterface $contextBuilder, PropertyAccessorInterface $propertyAccessor = null, NameConverterInterface $nameConverter = null)
    {
        parent::__construct($propertyNameCollectionFactory, $propertyMetadataFactory, $iriConverter, $resourceClassResolver, $propertyAccessor, $nameConverter);

        $this->itemNormalizer = $itemNormalizer;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->contextBuilder = $contextBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        return $this->itemNormalizer->denormalize($data, $class, ApiPlatformItemNormalizer::FORMAT, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        if ($format !== ApiPlatformItemNormalizer::FORMAT) {
            //embed context to avoid an additional request on encoding to e.g. rdf
            $context['jsonld_embed_context'] = true;
        }

        $normalizedData = $this->itemNormalizer->normalize($object, $format, $context);
        $filteredData = $this->filterNullValues($normalizedData);

        //todo remove after https://github.com/api-platform/api-platform/issues/128 is implemented
        $filteredData['@id'] =  $this->iriConverter->getIriFromItem($object, UrlGeneratorInterface::ABS_URL);

        return $filteredData;
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

    /**
     * Sets the owning Serializer object.
     *
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        parent::setSerializer($serializer);
        $this->itemNormalizer->setSerializer($serializer);
    }
}
