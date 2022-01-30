<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface RemoteRequestBusInterface
{
    /**
     * Dispatches a request to a remote RemoteResponseBus.
     *
     * @psalm-template T of object
     *
     * @psalm-param T $request
     *
     * @return bool returns true if the message was dispatched successfully, false otherwise
     */
    public function async(object $request): bool;

    /**
     * Dispatches a request to a remote RemoteResponseBus.
     * Blocks until the request is sent.
     *
     * @psalm-template T of object
     * @psalm-template R of object
     *
     * @psalm-param T $request
     * @psalm-return R
     *
     * @return object returns the response from the remote messenger
     */
    public function sync(object $request): object;
}
