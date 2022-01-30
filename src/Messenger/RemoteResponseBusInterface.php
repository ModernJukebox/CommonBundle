<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface RemoteResponseBusInterface
{
    /**
     * Dispatch the request to the MessageBus.
     *
     * @psalm-template T
     *
     * @psalm-param T $request
     *
     * @return AsyncRemoteResponseInterface the response, contains if dispatching the message was successful
     */
    public function async(mixed $request): AsyncRemoteResponseInterface;

    /**
     * Dispatch the request to the MessageBus and wait for the response and return it.
     *
     * @psalm-template T
     *
     * @psalm-param T $request
     *
     * @return SyncRemoteResponseInterface contains the response from the MessageBus
     */
    public function sync(mixed $request): SyncRemoteResponseInterface;
}
