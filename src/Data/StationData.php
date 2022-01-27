<?php

namespace ModernJukebox\Bundle\Common\Data;

use ModernJukebox\Bundle\Common\Enums\StationClientState;
use ModernJukebox\Bundle\Common\Enums\StationServerState;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Validator\Constraints as Assert;

class StationData
{
    #[Assert\Ulid]
    #[Assert\NotBlank]
    public Ulid $id;

    #[Assert\NotBlank]
    public string $address;

    #[Assert\NotBlank]
    public string $name;

    #[Assert\NotBlank]
    public StationClientState $clientState;

    #[Assert\NotBlank]
    public StationServerState $serverState;

    public ?string $clientError = null;

    public ?string $serverError = null;

    #[Assert\Valid]
    public StationPortsData $ports;

    #[Assert\NotBlank]
    #[Assert\Length(min: 16, max: 255)]
    public string $token;
}
