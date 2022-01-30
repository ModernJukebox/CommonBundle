<?php

namespace ModernJukebox\Bundle\Common\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ListenRequest
{
    #[Assert\NotBlank]
    private string $address;

    #[Assert\Range(min: 1, max: 65535)]
    private int $port;

    public function __construct(string $address, int $port = 1704)
    {
        $this->address = $address;
        $this->port = $port;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPort(): int
    {
        return $this->port;
    }
}
