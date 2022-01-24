<?php

namespace ModernJukebox\Bundle\Common\Data;

use Symfony\Component\Validator\Constraints as Assert;

class StationPortsData
{
    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 65535)]
    public int $http;

    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 65535)]
    public int $http3;

    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 65535)]
    public int $https;
}
