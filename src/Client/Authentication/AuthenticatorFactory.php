<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

class AuthenticatorFactory implements AuthenticatorFactoryInterface
{
    public function create(StrategyInterface $strategy, string $token): AuthenticatorInterface
    {
        return new Authenticator($strategy, $token);
    }
}
