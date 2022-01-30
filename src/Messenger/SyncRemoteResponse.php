<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;
use Symfony\Component\Validator\Constraints as Assert;

class SyncRemoteResponse implements SyncRemoteResponseInterface
{
    #[Assert\NotBlank]
    private string $response;

    #[Assert\NotBlank]
    private string $responseType;

    public function __construct(string $response, string $responseType)
    {
        $this->response = $response;
        $this->responseType = $responseType;
    }

    public function getMessageType(): RemoteMessageType
    {
        return RemoteMessageType::SYNC;
    }

    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @return class-string
     */
    public function getResponseType(): string
    {
        return $this->responseType;
    }
}
