<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;
use ModernJukebox\Bundle\Common\Exception\RuntimeException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\SerializerInterface;

class RemoteResponseBus implements RemoteResponseBusInterface
{
    private MessageBusInterface $messageBus;

    private SerializerInterface $serializer;

    public function __construct(MessageBusInterface $messageBus, SerializerInterface $serializer)
    {
        $this->messageBus = $messageBus;
        $this->serializer = $serializer;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(RemoteRequestInterface $remoteRequest): RemoteResponseInterface
    {
        $type = $remoteRequest->getRequestType();
        $request = $remoteRequest->getRequest();
        $message = $this->serializer->deserialize($request, $type, 'json');

        // @todo better error handling
        // @todo https://github.com/symfony/symfony/pull/39306
        $envelope = $this->messageBus->dispatch($message);

        if (RemoteMessageType::SYNC === $remoteRequest->getRequestType()) {
            $handledStamp = $envelope->last(HandledStamp::class);

            if (!$handledStamp) {
                throw new RuntimeException('No HandledStamp found');
            }

            $responseData = $handledStamp->getResult();

            if (!is_object($responseData)) {
                throw new RuntimeException('Response must be an object');
            }

            $responseType = get_class($responseData);
            $response = $this->serializer->serialize($responseData, 'json');

            return new SyncRemoteResponse($response, $responseType);
        }

        if (RemoteMessageType::ASYNC === $remoteRequest->getRequestType()) {
            return new AsyncRemoteResponse(true);
        }

        throw new RuntimeException('Unknown request type');
    }
}
