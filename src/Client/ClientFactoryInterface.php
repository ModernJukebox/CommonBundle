<?php

namespace ModernJukebox\Bundle\Common\Client;

use ModernJukebox\Bundle\Common\Client\Authentication\AuthenticatorInterface;

interface ClientFactoryInterface
{
    public function create(AuthenticatorInterface $authenticator): ClientInterface;
}
