<?php

namespace ModernJukebox\Bundle\Common\Tests\Client;

use ModernJukebox\Bundle\Common\Client\Authentication\Authenticator;
use ModernJukebox\Bundle\Common\Client\Authentication\NullStrategy;
use ModernJukebox\Bundle\Common\Client\Client;
use ModernJukebox\Bundle\Common\Client\ClientInterface;
use ModernJukebox\Bundle\Common\Client\ScopedClient;
use ModernJukebox\Bundle\Common\Tests\Fixtures\Client\Post;
use PHPUnit\Framework\TestCase;
use stdClass;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validation;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientTest extends TestCase
{
    private ?ClientInterface $client = null;

    private ?HttpClientInterface $httpClient = null;

    private ?Serializer $serializer = null;

    public function setUp(): void
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(), new ArrayDenormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);

        $this->validator = Validation::createValidator();

        $this->httpClient = HttpClient::create();

        $strategy = new NullStrategy();
        $authenticator = new Authenticator($strategy, 'yeet');

        $client = new Client($this->httpClient, $this->serializer, $this->validator, $authenticator);
        $this->client = new ScopedClient($client, 'http://localhost/');
    }

    public function tearDown(): void
    {
        $this->httpClient = null;
        $this->serializer = null;
        $this->client = null;
    }

    public function testClear(): void
    {
        $this->client->post('/clear', stdClass::class);

        $data = $this->client->get('/post', Post::class.'[]');

        self::assertCount(0, $data);
    }

    /**
     * @depends testPost
     */
    public function testGet(): void
    {
        $data = $this->client->get('/post/1', Post::class);

        $this->assertInstanceOf(Post::class, $data);
        $this->assertEquals(1, $data->id);
        $this->assertEquals('This is a test post', $data->title);
        $this->assertEquals('This is the body of the test post', $data->body);
    }

    /**
     * @depends testPost
     */
    public function testGetAll(): void
    {
        $data = $this->client->get('/post', Post::class.'[]');

        self::assertCount(2, $data);
        self::assertInstanceOf(Post::class, $data[0]);
        self::assertEquals(1, $data[0]->id);
        self::assertEquals('This is a test post', $data[0]->title);
        self::assertEquals('This is the body of the test post', $data[0]->body);
        self::assertInstanceOf(Post::class, $data[1]);
        self::assertEquals(2, $data[1]->id);
        self::assertEquals('This is a test post 2', $data[1]->title);
        self::assertEquals('This is the body of the test post 2', $data[1]->body);
    }

    /**
     * @depends testClear
     */
    public function testPost(): void
    {
        $createData = new Post();
        $createData->title = 'This is a test post';
        $createData->body = 'This is the body of the test post';

        $createdPost = $this->client->post('/post', Post::class, $createData);

        // Add another for get all test
        $createData->title = 'This is a test post 2';
        $createData->body = 'This is the body of the test post 2';
        $this->client->post('/post', Post::class, $createData);

        $this->assertEquals('This is a test post', $createdPost->title);
        $this->assertEquals('This is the body of the test post', $createdPost->body);
        $this->assertInstanceOf(Post::class, $createdPost);
        $this->assertEquals(1, $createdPost->id);
    }
}
