<?php

namespace ModernJukebox\Bundle\Common\Enums;

enum RemoteMessageType: string
{
    case SYNC = 'sync';
    case ASYNC = 'async';
}
