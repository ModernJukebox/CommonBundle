<?php

namespace ModernJukebox\Bundle\Common\Response;

class MpdCommandResponse
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
