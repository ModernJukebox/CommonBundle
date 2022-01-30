<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;

interface RemoteResponseBusFactoryInterface
{
    public function create(MessageBusInterface $messageBus): RemoteResponseBusInterface;
}
