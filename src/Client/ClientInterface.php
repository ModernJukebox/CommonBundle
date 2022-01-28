<?php

namespace ModernJukebox\Bundle\Common\Client;

interface ClientInterface
{
    public function get(string $path, string $responseType = null): mixed;

    public function post(string $path, string $responseType = null, mixed $data = null): mixed;
}
