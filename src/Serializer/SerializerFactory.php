<?php

namespace ModernJukebox\Bundle\Common\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerFactory
{
    private DateTimeNormalizer $dateTimeNormalizer;

    private SerializerInterface $defaultSerializer;

    private ObjectNormalizer $objectNormalizer;

    private UidNormalizer $uidNormalizer;

    public function __construct(SerializerInterface $defaultSerializer, ObjectNormalizer $objectNormalizer, DateTimeNormalizer $dateTimeNormalizer, UidNormalizer $uidNormalizer)
    {
        $this->defaultSerializer = $defaultSerializer;
        $this->objectNormalizer = $objectNormalizer;
        $this->dateTimeNormalizer = $dateTimeNormalizer;
        $this->uidNormalizer = $uidNormalizer;
    }

    public function create(bool $useDefaultSerializer = false): SerializerInterface
    {
        if ($useDefaultSerializer) {
            return $this->defaultSerializer;
        }

        $encoders = [new JsonEncoder()];
        $normalizers = [
            $this->uidNormalizer,
            new JsonSerializableNormalizer(),
            $this->dateTimeNormalizer,
            new BackedEnumNormalizer(),
            new ArrayDenormalizer(),
            $this->objectNormalizer,
        ];

        return new Serializer($normalizers, $encoders);
    }
}
