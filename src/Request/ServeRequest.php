<?php

namespace ModernJukebox\Bundle\Common\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ServeRequest
{
    #[Assert\NotBlank]
    private string $token;

    #[Assert\NotBlank]
    private string $endpoint;

    public function __construct(string $token, string $endpoint)
    {
        $this->token = $token;
        $this->endpoint = $endpoint;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
