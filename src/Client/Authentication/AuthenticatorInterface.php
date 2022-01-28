<?php

namespace ModernJukebox\Bundle\Common\Client\Authentication;

use Symfony\Component\HttpFoundation\Request;

interface AuthenticatorInterface
{
    public function authenticate(Request $request): Request;
}
