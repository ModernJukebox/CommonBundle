<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\Response\GenericStatusResponseData;
use ModernJukebox\Bundle\Common\Enums\StationServerState;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see GenericStatusResponseData
 */
class StationReportServerStateRequestData
{
    #[Assert\NotBlank]
    public StationServerState $state;

    public ?string $error = null;
}
