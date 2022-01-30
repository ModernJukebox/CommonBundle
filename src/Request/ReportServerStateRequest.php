<?php

namespace ModernJukebox\Bundle\Common\Request;

use ModernJukebox\Bundle\Common\Enums\StationServerState;
use Symfony\Component\Validator\Constraints as Assert;

class ReportServerStateRequest
{
    private ?string $error;

    #[Assert\NotBlank]
    private StationServerState $state;

    public function __construct(StationServerState $state, ?string $error = null)
    {
        $this->state = $state;
        $this->error = $error;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getState(): StationServerState
    {
        return $this->state;
    }
}
