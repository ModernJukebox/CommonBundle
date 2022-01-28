<?php

namespace ModernJukebox\Bundle\Common\Exception;

use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpFoundation\Request;

class RequestFailedException extends RuntimeException
{
    private Request $request;

    public function __construct(Request $request, ServerException|ClientException|RedirectionException $previous)
    {
        $response = $previous->getResponse();
        $this->request = $request;

        $message = "Failed to request {$request->getMethod()} {$request->getUri()}";

        parent::__construct($message, $response->getStatusCode(), $previous);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
