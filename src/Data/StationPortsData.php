<?php

namespace ModernJukebox\Bundle\Common\Data;

use Symfony\Component\Validator\Constraints as Assert;

class StationPortsData
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 5)]
    public int $http;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 5)]
    public int $http3;

    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 5)]
    public int $https;
}
