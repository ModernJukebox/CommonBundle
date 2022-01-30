<?php

namespace ModernJukebox\Bundle\Common\Tests\Fixtures;

use ModernJukebox\Bundle\Common\Attribute\ResponseType;

#[ResponseType(type: ListResponse::class)]
class ListRequest
{
    private string $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }
}
