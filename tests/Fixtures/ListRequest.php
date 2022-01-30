<?php

namespace ModernJukebox\Bundle\Common\Tests\Fixtures;

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
