<?php

namespace ModernJukebox\Bundle\Common\Client;

interface ClientInterface
{
    /**
     * @psalm-template  T
     * @psalm-template  P of class-string<T>|null
     *
     * @psalm-param (T is null ? string : T) $responseType
     *
     * @psalm-return T
     */
    public function get(string $path, string|null $responseType = null): mixed;

    /**
     * @psalm-template  T
     * @psalm-template  P of class-string<T>|null
     *
     * @psalm-param (T is null ? string : T) $responseType
     *
     * @psalm-return T
     */
    public function post(string $path, string|null $responseType = null, mixed $data = null): mixed;
}
