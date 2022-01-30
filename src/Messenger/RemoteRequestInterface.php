<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;

interface RemoteRequestInterface
{
    public function getMessageType(): RemoteMessageType;

    public function getRequest(): string;

    /**
     * @return class-string
     */
    public function getRequestType(): string;
}
