<?php

namespace ModernJukebox\Bundle\Common\Data\Response;

use ModernJukebox\Bundle\Common\Data\StationData;
use Symfony\Component\Validator\Constraints as Assert;

class StationRegisterResponseData extends GenericStatusResponseData
{
    #[Assert\Valid]
    public StationData $station;
}
