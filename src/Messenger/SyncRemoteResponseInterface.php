<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface SyncRemoteResponseInterface extends RemoteResponseInterface
{
    /**
     * @psalm-return class-string
     */
    public function getResponseType(): string;

    public function getResponse(): string;
}
