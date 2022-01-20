<?php

namespace ModernJukebox\Bundle\Common\Data;

use Symfony\Component\Validator\Constraints as Assert;

class StationData
{
    #[Assert\NotBlank]
    public string $address;

    #[Assert\NotBlank]
    #[Assert\Length(min: 16, max: 255)]
    public string $token;

    #[Assert\Valid]
    public StationPortsData $ports;
}
