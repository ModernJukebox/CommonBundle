<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\Response\GenericStatusResponseData;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see GenericStatusResponseData
 */
class StationServeRequestData
{
    #[Assert\NotBlank]
    public string $mode;
}
