<?php

namespace ModernJukebox\Bundle\Common\Enums;

enum FilesystemItemType: string
{
    case FILE = 'file';
    case DIRECTORY = 'directory';
}
