<?php

namespace ModernJukebox\Bundle\Common\Tests\Messenger;

use ModernJukebox\Bundle\Common\Client\Authentication\Authenticator;
use ModernJukebox\Bundle\Common\Client\Authentication\NullStrategy;
use ModernJukebox\Bundle\Common\Client\Client;
use ModernJukebox\Bundle\Common\Client\ClientInterface;
use ModernJukebox\Bundle\Common\Client\ScopedClient;
use ModernJukebox\Bundle\Common\Messenger\RemoteRequestBus;
use ModernJukebox\Bundle\Common\Tests\Fixtures\ListRequest;
use ModernJukebox\Bundle\Common\Tests\Fixtures\ListResponse;
use ModernJukebox\Bundle\Common\Tests\Fixtures\SendEmailRequest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validation;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RemoteRequestBusTest extends TestCase
{
    private ?ClientInterface $client = null;

    private ?HttpClientInterface $httpClient = null;

    private ?RemoteRequestBus $remoteRequestBus = null;

    private ?Serializer $serializer = null;

    public function setUp(): void
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new BackedEnumNormalizer(), new ObjectNormalizer(), new ArrayDenormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);

        $this->validator = Validation::createValidator();

        $this->httpClient = HttpClient::create();

        $strategy = new NullStrategy();
        $authenticator = new Authenticator($strategy, 'yeet');

        $client = new Client($this->httpClient, $this->serializer, $this->validator, $authenticator);
        $this->client = new ScopedClient($client, 'http://localhost/');
        $this->remoteRequestBus = new RemoteRequestBus($this->serializer, $this->client, '/messages');
    }

    public function tearDown(): void
    {
        $this->httpClient = null;
        $this->serializer = null;
        $this->client = null;
        $this->remoteRequestBus = null;
    }

    public function testSyncRequest(): void
    {
        /**
         * @var ListResponse $response
         */
        $response = $this->remoteRequestBus->sync(new ListRequest('/var'));

        self::assertInstanceOf(ListResponse::class, $response);
        self::assertContains('/var/tmp', $response->getItems());
        self::assertContains('/var/run', $response->getItems());
    }

    public function testAsyncRequest(): void
    {
        /**
         * @var bool $response
         */
        $success = $this->remoteRequestBus->async(new SendEmailRequest('Test E-Mail'));

        self::assertIsBool($success);
        self::assertTrue($success);
    }
}
