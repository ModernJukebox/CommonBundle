<?php

namespace ModernJukebox\Bundle\Common\Data\Filesystem;

use JsonSerializable;
use ModernJukebox\Bundle\Common\Enums\FilesystemItemType;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
use Symfony\Component\Validator\Constraints as Assert;

#[DiscriminatorMap(
    'type',
    [
        'directory' => DirectoryItemData::class,
        'file' => FileItemData::class,
    ]
)]
abstract class AbstractItemData implements JsonSerializable
{
    #[Assert\NotBlank]
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getBasename(): string
    {
        return basename($this->path);
    }

    public function getDirectory(): DirectoryItemData
    {
        return new DirectoryItemData(dirname($this->path));
    }

    public function getPath(): string
    {
        return $this->path;
    }

    abstract public function getType(): FilesystemItemType;

    public function jsonSerialize(): mixed
    {
        return [
            'path' => $this->path,
            'type' => $this->getType(),
        ];
    }
}
