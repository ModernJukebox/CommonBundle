<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface SyncRemoteResponseInterface extends RemoteResponseInterface
{
    /**
     * @return class-string
     */
    public function getResponseType(): string;

    public function getResponse(): string;
}
