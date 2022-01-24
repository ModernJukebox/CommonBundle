<?php

namespace ModernJukebox\Bundle\Common\Data;

use ModernJukebox\Bundle\Common\Enums\StationState;
use Symfony\Component\Validator\Constraints as Assert;

class StationStateData
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    public StationState $state;
}
