<?php

namespace ModernJukebox\Bundle\Common\Data\Response;

use Symfony\Component\Validator\Constraints as Assert;

class StationMpdCommandResponseData extends GenericStatusResponseData
{
    #[Assert\NotBlank]
    public string $result;
}
