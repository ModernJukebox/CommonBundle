<?php

namespace ModernJukebox\Bundle\Common\Response;

class AlsaCommandResponse
{
    private ?string $result;

    public function __construct(?string $result = null)
    {
        $this->result = $result;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }
}
