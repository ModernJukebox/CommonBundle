<?php

namespace ModernJukebox\Bundle\Common\Stamp;

use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Uid\Ulid;

final class StationAwareStamp implements StampInterface
{
    private Ulid $stationId;

    public function __construct(Ulid $stationId)
    {
        $this->stationId = $stationId;
    }

    public function getStationId(): Ulid
    {
        return $this->stationId;
    }
}
