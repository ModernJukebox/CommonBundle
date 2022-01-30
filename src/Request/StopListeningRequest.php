<?php

namespace ModernJukebox\Bundle\Common\Request;

use ModernJukebox\Bundle\Common\Enums\StationClientState;

class StopListeningRequest
{
    private StationClientState $state;

    public function __construct(StationClientState $state = StationClientState::IDLE)
    {
        $this->state = $state;
    }

    public function getState(): StationClientState
    {
        return $this->state;
    }
}
