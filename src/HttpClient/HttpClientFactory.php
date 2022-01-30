<?php

namespace ModernJukebox\Bundle\Common\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpClientFactory
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(bool $isProduction): HttpClientInterface
    {
        $httpClient = $this->httpClient;

        if (!$isProduction) {
            $httpClient = $httpClient->withOptions([
                'verify_peer' => false,
                'verify_host' => false,
            ]);
        }

        return $httpClient;
    }
}
