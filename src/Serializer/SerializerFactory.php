<?php

namespace ModernJukebox\Bundle\Common\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerFactory
{
    private SerializerInterface $defaultSerializer;

    public function __construct(SerializerInterface $defaultSerializer)
    {
        $this->defaultSerializer = $defaultSerializer;
    }

    public function create(bool $useDefaultSerializer = false): SerializerInterface
    {
        if ($useDefaultSerializer) {
            return $this->defaultSerializer;
        }

        $encoders = [new JsonEncoder()];
        $normalizers = [new ArrayDenormalizer(), new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}
