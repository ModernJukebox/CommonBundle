<?php

namespace ModernJukebox\Bundle\Common\Tests;

use ModernJukebox\Bundle\Common\Attribute\FromBody;
use ModernJukebox\Bundle\Common\Controller\ArgumentResolver\BodyDataValueResolver;
use ModernJukebox\Bundle\Common\Tests\Fixtures\ExampleData;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BodyDataValueResolverTest extends TestCase
{
    private ?SerializerInterface $serializer = null;

    private ?ValidatorInterface $validator = null;

    public function testSupports(): void
    {
        $resolver = new BodyDataValueResolver($this->serializer, $this->validator);

        $request = Request::create('/', 'POST', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], '{"foo":"bar", "bar":"baz"}');

        $argumentMetadata = new ArgumentMetadata(
            'test',
            ExampleData::class,
            false,
            false,
            null,
            false,
            [new FromBody()]
        );

        $this->assertTrue($resolver->supports($request, $argumentMetadata));
    }

    public function testResolve(): void
    {
        $resolver = new BodyDataValueResolver($this->serializer, $this->validator);

        $request = Request::create('/', 'POST', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], '{"foo":"bar", "bar":"baz"}');

        $argumentMetadata = new ArgumentMetadata(
            'test',
            ExampleData::class,
            false,
            false,
            null,
            false,
            [new FromBody()]
        );

        $values = $resolver->resolve($request, $argumentMetadata);

        self::assertCount(1, $values);
        self::assertInstanceOf(ExampleData::class, $values[0]);
    }

    protected function setUp(): void
    {
        $this->validator = Validation::createValidatorBuilder()
            ->getValidator();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    protected function tearDown(): void
    {
        $this->serializer = null;
        $this->validator = null;
    }
}
