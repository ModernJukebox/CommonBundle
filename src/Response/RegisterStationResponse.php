<?php

namespace ModernJukebox\Bundle\Common\Response;

use ModernJukebox\Bundle\Common\Data\StationData;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterStationResponse
{
    #[Assert\Valid]
    private StationData $station;

    public function __construct(StationData $station)
    {
        $this->station = $station;
    }

    public function getStation(): StationData
    {
        return $this->station;
    }
}
