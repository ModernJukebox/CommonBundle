<?php

namespace ModernJukebox\Bundle\Common\Data;

use ModernJukebox\Bundle\Common\Enums\StationState;
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
    public StationState $state;

    public ?string $error = null;

    #[Assert\Valid]
    public StationPortsData $ports;

    #[Assert\NotBlank]
    #[Assert\Length(min: 16, max: 255)]
    public string $token;
}
