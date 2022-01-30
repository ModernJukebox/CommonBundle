<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Client\ClientInterface;

interface RemoteRequestBusFactoryInterface
{
    public function create(ClientInterface $client, string $messageEndpointPath): RemoteRequestBusInterface;
}
