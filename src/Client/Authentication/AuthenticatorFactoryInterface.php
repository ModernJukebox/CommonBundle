<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

interface AuthenticatorFactoryInterface
{
    public function create(StrategyInterface $strategy, string $token): AuthenticatorInterface;
}
