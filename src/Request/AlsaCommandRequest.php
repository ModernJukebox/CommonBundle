<?php

namespace ModernJukebox\Bundle\Common\Request;

use Symfony\Component\Validator\Constraints as Assert;

class AlsaCommandRequest
{
    /**
     * @var string[] $options
     */
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Type('string'),
    ])]
    private array $options = [];

    #[Assert\NotBlank]
    private string $command;

    /**
     * @var string[] $arguments
     */
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Type('string'),
    ])]
    private array $arguments = [];

    public function __construct(string $command, array $options = [], array $arguments = [])
    {
        $this->command = $command;
        $this->options = $options;
        $this->arguments = $arguments;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
