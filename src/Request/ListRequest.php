<?php

namespace ModernJukebox\Bundle\Common\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ListRequest
{
    #[Assert\NotBlank()]
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
