<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;

class AsyncRemoteResponse implements AsyncRemoteResponseInterface
{
    private bool $success;

    public function __construct(bool $success = true)
    {
        $this->success = $success;
    }

    public function getMessageType(): RemoteMessageType
    {
        return RemoteMessageType::ASYNC;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }
}
