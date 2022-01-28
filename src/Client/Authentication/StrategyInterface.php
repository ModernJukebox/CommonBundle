<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

use Symfony\Component\HttpFoundation\Request;

interface StrategyInterface
{
    public function authenticate(Request $request, string $token): Request;
}
