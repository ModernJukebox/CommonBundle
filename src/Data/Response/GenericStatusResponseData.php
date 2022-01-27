<?php

namespace ModernJukebox\Bundle\Common\Data\Response;

use Symfony\Component\Validator\Constraints as Assert;

class GenericStatusResponseData
{
    #[Assert\NotBlank]
    public string $status = 'OK';
}
