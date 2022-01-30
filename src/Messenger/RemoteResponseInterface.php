<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;

interface RemoteResponseInterface
{
    public function getMessageType(): RemoteMessageType;
}
