<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\Response\GenericStatusResponseData;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see GenericStatusResponseData
 */
class StationListenRequestData
{
    #[Assert\NotBlank]
    public string $address;

    #[Assert\Range(min: 1, max: 65535)]
    public int $port = 1704;
}
