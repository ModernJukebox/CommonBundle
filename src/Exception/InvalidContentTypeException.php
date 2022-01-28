<?php

namespace ModernJukebox\Bundle\Common\Exception;

class InvalidContentTypeException extends RuntimeException
{
    private string $contentType;

    private string $expectedContentTypes;

    public function __construct(string $contentType, string $expectedContentTypes)
    {
        parent::__construct('Invalid content type: '.$contentType.' expected: '.$expectedContentTypes);

        $this->contentType = $contentType;
        $this->expectedContentTypes = $expectedContentTypes;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getExpectedContentTypes(): string
    {
        return $this->expectedContentTypes;
    }
}
