<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\Response\GenericStatusResponseData;
use ModernJukebox\Bundle\Common\Enums\StationClientState;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see GenericStatusResponseData
 */
class StationReportClientStateRequestData
{
    #[Assert\NotBlank]
    public StationClientState $state;

    public ?string $error = null;
}
