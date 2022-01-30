<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RemoteResponseBusFactory implements RemoteResponseBusFactoryInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function create(MessageBusInterface $messageBus): RemoteResponseBusInterface
    {
        return new RemoteResponseBus($this->messageBus, $this->serializer);
    }
}
