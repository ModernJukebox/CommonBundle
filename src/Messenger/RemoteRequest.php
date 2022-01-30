<?php

namespace ModernJukebox\Bundle\Common\Messenger;

use ModernJukebox\Bundle\Common\Enums\RemoteMessageType;
use Symfony\Component\Validator\Constraints as Assert;

class RemoteRequest implements RemoteRequestInterface
{
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private RemoteMessageType $messageType;

    #[Assert\NotBlank]
    private string $request;

    /**
     * @psalm-var class-string $requestType
     */
    #[Assert\NotBlank]
    private string $requestType;

    /**
     * @psalm-param class-string $requestType
     */
    public function __construct(RemoteMessageType $messageType, string $request, string $requestType)
    {
        $this->messageType = $messageType;
        $this->request = $request;
        $this->requestType = $requestType;
    }

    public function getMessageType(): RemoteMessageType
    {
        return $this->messageType;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @psalm-return class-string
     */
    public function getRequestType(): string
    {
        return $this->requestType;
    }
}
