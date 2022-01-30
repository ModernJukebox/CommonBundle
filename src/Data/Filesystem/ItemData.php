<?php

namespace ModernJukebox\Bundle\Common\Data\Filesystem;

use Symfony\Component\Validator\Constraints as Assert;

class ItemData
{
    #[Assert\NotBlank]
    public string $directory;

    #[Assert\NotBlank]
    public string $name;
}
