<?php

namespace ModernJukebox\Bundle\Common\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ServeRequest
{
    #[Assert\NotBlank]
    private string $mode;

    public function __construct(string $mode)
    {
        $this->mode = $mode;
    }

    public function getMode(): string
    {
        return $this->mode;
    }
}
