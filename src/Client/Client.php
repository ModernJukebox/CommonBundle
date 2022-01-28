<?php

namespace ModernJukebox\Bundle\Common\Client;

use ModernJukebox\Bundle\Common\Client\Authentication\AuthenticatorInterface;
use ModernJukebox\Bundle\Common\Exception\InvalidArgumentException;
use ModernJukebox\Bundle\Common\Exception\InvalidContentTypeException;
use ModernJukebox\Bundle\Common\Exception\RequestFailedException;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\RedirectionException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Client implements ClientInterface
{
    private AuthenticatorInterface $authenticator;

    private HTtpClientInterface $httpClient;

    private SerializerInterface $serializer;

    private ValidatorInterface $validator;

    public function __construct(
        HttpClientInterface $httpClient,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        AuthenticatorInterface $authenticator
    ) {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->authenticator = $authenticator;
        $this->validator = $validator;
    }

    public function get(string $path, string $responseType = null): mixed
    {
        $request = Request::create($path, Request::METHOD_GET);
        $response = $this->request($request);
        $content = $this->validateResponse($request, $response);

        if (null === $responseType) {
            return $content;
        }

        $data = $this->serializer->deserialize($content, $responseType, 'json');

        $this->validateResponseData($data);

        return $data;
    }

    protected function request(Request $request): ResponseInterface
    {
        $this->authenticator->authenticate($request);

        $request->headers->set('Accept', 'application/json');

        $content = $request->getContent();

        // Request actually changed null to empty string, so return it back
        if (empty($content)) {
            $content = null;
        }

        // If content is not null, then its Content-Type is application/json
        if (null !== $content) {
            $request->headers->set('Content-Type', 'application/json');
        }

        $method = $request->getMethod();
        $url = $request->getUri();
        $headers = $request->headers->all();

        $options = [
            'headers' => $headers,
        ];

        if (in_array($method, [Request::METHOD_POST, Request::METHOD_PUT, Request::METHOD_PATCH], true)) {
            $options['json'] = $content;
        }

        return $this->httpClient->request($method, $url, $options);
    }

    private function validateResponse(Request $request, ResponseInterface $response): string
    {
        try {
            $content = $response->getContent(true);

            if (!$this->isJson($content)) {
                $headers = $response->getHeaders();
                $contentType = $headers['content-type'][0] ?? 'unknown';

                throw new InvalidContentTypeException($contentType, 'application/json');
            }

            return $content;
        } catch (ServerException|ClientException|RedirectionException $exception) {
            throw new RequestFailedException($request, $exception);
        }
    }

    private function validateResponseData(mixed $data): void
    {
        $constraintViolations = $this->validator->validate($data);

        if (count($constraintViolations) > 0) {
            throw new InvalidArgumentException('Response data is invalid', 0, new ValidationFailedException($data, $constraintViolations));
        }
    }

    private function isJson(string $content): bool
    {
        try {
            json_decode($content, false, 512, JSON_THROW_ON_ERROR);

            return true;
        } catch (\JsonException $exception) {
            return false;
        }
    }

    public function post(string $path, string $responseType = null, mixed $data = null): mixed
    {
        if (null !== $data) {
            $constraintViolations = $this->validator->validate($data);

            if (count($constraintViolations) > 0) {
                throw new InvalidArgumentException('Invalid data provided', 0, new ValidationFailedException($data, $constraintViolations));
            }
        }

        $request = Request::create($path, Request::METHOD_POST, [], [], [], [], $data);
        $response = $this->request($request);
        $content = $this->validateResponse($request, $response);

        if (null === $responseType) {
            return $content;
        }

        $data = $this->serializer->deserialize($content, $responseType, 'json');

        $this->validateResponseData($data);

        return $data;
    }
}
