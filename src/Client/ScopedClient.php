<?php

namespace ModernJukebox\Bundle\Common\Client;

class ScopedClient implements ClientInterface
{
    private string $baseUrl;

    private ClientInterface $client;

    public function __construct(ClientInterface $client, string $baseUrl)
    {
        $this->client = $client;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $path, string $responseType = null): mixed
    {
        $url = $this->baseUrl.'/'.ltrim($path, '/');

        return $this->client->get($url, $responseType);
    }

    /**
     * {@inheritDoc}
     */
    public function post(string $path, string $responseType = null, mixed $data = null): mixed
    {
        $url = $this->baseUrl.'/'.ltrim($path, '/');

        return $this->client->post($url, $responseType, $data);
    }
}
