<?php

namespace ModernJukebox\Bundle\Common\Response;

use ModernJukebox\Bundle\Common\Data\Filesystem\DirectoryItemData;
use ModernJukebox\Bundle\Common\Data\Filesystem\FileItemData;
use Symfony\Component\Validator\Constraints as Assert;

class ListResponse
{
    #[Assert\All([
        new Assert\AtLeastOneOf([
            new Assert\Type(FileItemData::class),
            new Assert\Type(DirectoryItemData::class),
        ]),
    ])]
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
