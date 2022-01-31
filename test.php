<?php

use Doctrine\Common\Annotations\AnnotationReader;
use ModernJukebox\Bundle\Common\Data\Filesystem\AbstractItemData;
use ModernJukebox\Bundle\Common\Data\Filesystem\DirectoryItemData;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\ClassDiscriminatorFromClassMetadata;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;

require './vendor/autoload.php';

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

$discriminator = new ClassDiscriminatorFromClassMetadata($classMetadataFactory);

$encoders = [new JsonEncoder()];
$normalizers = [
    new UidNormalizer(),
    new JsonSerializableNormalizer(),
    new DateTimeNormalizer(),
    new BackedEnumNormalizer(),
    new ArrayDenormalizer(),
    new ObjectNormalizer($classMetadataFactory, null, null, new ReflectionExtractor(), $discriminator),
];

$serializer = new Serializer($normalizers, $encoders);
$customSerializer = clone $serializer;

$data = new DirectoryItemData(__DIR__);

$serialized = $customSerializer->serialize($data, 'json');

var_dump($serialized);

$deserialized = $customSerializer->deserialize($serialized, AbstractItemData::class, 'json');

var_dump($deserialized);
