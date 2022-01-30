<?php

namespace ModernJukebox\Bundle\Common\Request;

use ModernJukebox\Bundle\Common\Data\StationPortsData;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterStationRequest
{
    #[Assert\NotBlank]
    private string $address;

    #[Assert\NotBlank]
    #[Assert\Length(min: 16, max: 255)]
    private string $token;

    #[Assert\Valid]
    private StationPortsData $ports;

    public function __construct(string $address, string $token, StationPortsData $ports)
    {
        $this->address = $address;
        $this->token = $token;
        $this->ports = $ports;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPorts(): StationPortsData
    {
        return $this->ports;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
