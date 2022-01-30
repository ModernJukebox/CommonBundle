<?php

namespace ModernJukebox\Bundle\Common\Data\Filesystem;

use ModernJukebox\Bundle\Common\Enums\FilesystemItemType;

class FileItemData extends AbstractItemData
{
    public function getExtension(): string
    {
        $extension = '';
        $basename = $this->getBasename();
        $length = strlen($basename);

        for ($i = $length - 1; $i >= 0; --$i) {
            if ('.' === $basename[$i]) {
                $extension = substr($basename, $i + 1);
                break;
            }
        }

        return $extension;
    }

    public function getType(): FilesystemItemType
    {
        return FilesystemItemType::FILE;
    }
}
