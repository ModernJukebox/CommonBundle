<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\StationPortsData;
use Symfony\Component\Validator\Constraints as Assert;

class StationRegisterRequestData
{
    #[Assert\NotBlank]
    public string $address;

    #[Assert\NotBlank]
    #[Assert\Length(min: 16, max: 255)]
    public string $token;

    #[Assert\Valid]
    public StationPortsData $ports;
}
