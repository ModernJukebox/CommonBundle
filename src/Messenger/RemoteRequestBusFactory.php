<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Client\ClientInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RemoteRequestBusFactory implements RemoteRequestBusFactoryInterface
{
    private SerializerInterface $serializer;

    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function create(ClientInterface $client, string $messageEndpointPath): RemoteRequestBusInterface
    {
        return new RemoteRequestBus($this->serializer, $this->validator, $client, $messageEndpointPath);
    }
}
