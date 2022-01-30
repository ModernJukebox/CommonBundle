<?php

namespace ModernJukebox\Bundle\Common\Request;

use ModernJukebox\Bundle\Common\Enums\StationServerState;

class StopServingRequest
{
    private StationServerState $state;

    public function __construct(StationServerState $state = StationServerState::IDLE)
    {
        $this->state = $state;
    }

    public function getState(): StationServerState
    {
        return $this->state;
    }
}
