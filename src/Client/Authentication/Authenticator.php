<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

use Symfony\Component\HttpFoundation\Request;

class Authenticator implements AuthenticatorInterface
{
    private StrategyInterface $strategy;

    private string $token;

    public function __construct(StrategyInterface $strategy, string $token)
    {
        $this->strategy = $strategy;
        $this->token = $token;
    }

    public function authenticate(Request $request): Request
    {
        return $this->strategy->authenticate($request, $this->token);
    }
}
