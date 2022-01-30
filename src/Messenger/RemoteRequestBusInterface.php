<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface RemoteRequestBusInterface
{
    /**
     * Dispatches a request to a remote RemoteResponseBus.
     *
     * @psalm-template T
     *
     * @psalm-param T $request
     *
     * @return bool returns true if the message was dispatched successfully, false otherwise
     */
    public function async(mixed $request): bool;

    /**
     * Dispatches a request to a remote RemoteResponseBus.
     * Blocks until the request is sent.
     *
     * @psalm-template T
     * @psalm-template R
     *
     * @psalm-param T $request
     * @psalm-return R
     *
     * @return mixed returns the response from the remote messenger
     */
    public function sync(mixed $request): mixed;
}
