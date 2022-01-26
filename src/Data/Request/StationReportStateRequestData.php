<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\Response\GenericStatusResponseData;
use ModernJukebox\Bundle\Common\Enums\StationState;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see GenericStatusResponseData
 */
class StationReportStateRequestData
{
    #[Assert\NotBlank]
    public StationState $state;
}
