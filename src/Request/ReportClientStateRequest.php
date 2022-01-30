<?php

namespace ModernJukebox\Bundle\Common\Request;

use ModernJukebox\Bundle\Common\Enums\StationClientState;
use Symfony\Component\Validator\Constraints as Assert;

class ReportClientStateRequest
{
    private ?string $error;

    #[Assert\NotBlank]
    private StationClientState $state;

    public function __construct(StationClientState $state, ?string $error = null)
    {
        $this->state = $state;
        $this->error = $error;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function getState(): StationClientState
    {
        return $this->state;
    }
}
