<?php

namespace ModernJukebox\Bundle\Common\Data;

use Symfony\Component\Validator\Constraints as Assert;

class ListenCommandData
{
    #[Assert\NotBlank]
    public string $address;

    #[Assert\Range(min: 1, max: 65535)]
    public int $port = 1704;
}
