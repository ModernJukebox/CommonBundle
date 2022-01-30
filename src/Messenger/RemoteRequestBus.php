<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Client\ClientInterface;
use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;
use ModernJukebox\Bundle\Common\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RemoteRequestBus implements RemoteRequestBusInterface
{
    private ClientInterface $client;

    private string $messageEndpointPath;

    private SerializerInterface $serializer;

    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, ClientInterface $client, string $messageEndpointPath)
    {
        $this->serializer = $serializer;
        $this->client = $client;
        $this->messageEndpointPath = $messageEndpointPath;
        $this->validator = $validator;
    }

    /**
     * {@inheritDoc}
     */
    public function async(object $request): bool
    {
        $this->validateRequest($request);

        $serializedRequest = $this->serializer->serialize($request, 'json');
        $remoteMessage = new RemoteRequest(RemoteMessageType::ASYNC, $serializedRequest, get_class($request));

        /**
         * @var AsyncRemoteResponse $remoteResponse
         */
        $remoteResponse = $this->client->post($this->messageEndpointPath, AsyncRemoteResponse::class, $remoteMessage);

        return $remoteResponse->isSuccess();
    }

    /**
     * {@inheritDoc}
     */
    public function sync(object $request): object
    {
        $this->validateRequest($request);

        $serializedRequest = $this->serializer->serialize($request, 'json');
        $remoteMessage = new RemoteRequest(RemoteMessageType::SYNC, $serializedRequest, get_class($request));

        /**
         * @var SyncRemoteResponse $remoteResponse
         */
        $remoteResponse = $this->client->post($this->messageEndpointPath, SyncRemoteResponse::class, $remoteMessage);
        $response = $remoteResponse->getResponse();
        $responseType = $remoteResponse->getResponseType();
        $deserializedResponse = $this->serializer->deserialize($response, $responseType, 'json');

        return $deserializedResponse;
    }

    private function validateRequest(object $request)
    {
        $constraintViolations = $this->validator->validate($request);

        if (count($constraintViolations) > 0) {
            throw new InvalidArgumentException('Invalid request', 0, new ValidationFailedException($request, $constraintViolations));
        }
    }
}
