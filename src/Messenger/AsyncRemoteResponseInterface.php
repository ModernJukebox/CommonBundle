<?php

namespace ModernJukebox\Bundle\Common\Messenger;

interface AsyncRemoteResponseInterface extends RemoteResponseInterface
{
    public function isSuccess(): bool;
}
