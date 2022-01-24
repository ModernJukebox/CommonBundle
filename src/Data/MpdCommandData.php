<?php

namespace ModernJukebox\Bundle\Common\Data;

use Symfony\Component\Validator\Constraints as Assert;

class MpdCommandData
{
    #[Assert\NotBlank]
    public string $command;

    /**
     * @var string[] $arguments
     */
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Type('string'),
    ])]
    public array $arguments = [];
}
