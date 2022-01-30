<?php

namespace ModernJukebox\Bundle\Common\Client;

use ModernJukebox\Bundle\Common\Client\Authentication\AuthenticatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientFactory implements ClientFactoryInterface
{
    private HttpClientInterface $httpClient;

    private SerializerInterface $serializer;

    private ValidatorInterface $validator;

    public function __construct(
        HttpClientInterface $httpClient,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
    ) {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function create(AuthenticatorInterface $authenticator): ClientInterface
    {
        return new Client(
            $this->httpClient,
            $this->serializer,
            $this->validator,
            $authenticator,
        );
    }
}
