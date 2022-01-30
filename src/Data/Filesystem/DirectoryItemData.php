<?php

namespace ModernJukebox\Bundle\Common\Data\Filesystem;

use ModernJukebox\Bundle\Common\Enums\FilesystemItemType;

class DirectoryItemData extends AbstractItemData
{
    public function getType(): FilesystemItemType
    {
        return FilesystemItemType::DIRECTORY;
    }
}
