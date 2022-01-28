<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

use Symfony\Component\HttpFoundation\Request;

class NullStrategy implements StrategyInterface
{
    public function authenticate(Request $request, string $token): Request
    {
        return $request;
    }
}
