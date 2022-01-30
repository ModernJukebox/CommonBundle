<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Client\ClientInterface;
use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;
use Symfony\Component\Serializer\SerializerInterface;

class RemoteRequestBus implements RemoteRequestBusInterface
{
    private ClientInterface $client;

    private string $messageEndpointPath;

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer, ClientInterface $client, string $messageEndpointPath)
    {
        $this->serializer = $serializer;
        $this->client = $client;
        $this->messageEndpointPath = $messageEndpointPath;
    }

    /**
     * {@inheritDoc}
     */
    public function async(mixed $request): bool
    {
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
    public function sync(mixed $request): mixed
    {
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
}
