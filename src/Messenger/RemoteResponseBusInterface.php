<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface RemoteResponseBusInterface
{
    /**
     * Handles the request and returns the response.
     */
    public function handle(RemoteRequestInterface $remoteRequest, array $stamps = []): RemoteResponseInterface;
}
