<?php

namespace ModernJukebox\Bundle\Common\Data\Request;

use ModernJukebox\Bundle\Common\Data\Response\StationMpdCommandResponseData;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @see StationMpdCommandResponseData
 */
class StationMpdCommandRequestData
{
    /**
     * @var string[] $options
     */
    #[Assert\All([
        new Assert\NotBlank(),
        new Assert\Type('string'),
    ])]
    public array $options = [];

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
