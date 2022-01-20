<?php
/*
 * This file is part of the ModernJukebox/CommonBundle package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ModernJukebox\Bundle\Common\Controller\ArgumentResolver;

use ModernJukebox\Bundle\Common\Attribute\FromBody;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BodyDataValueResolver implements ArgumentValueResolverInterface
{
    private SerializerInterface $serializer;

    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $content = $request->getContent();
        $type = $argument->getType();

        $data = $this->serializer->deserialize($content, $type, 'json');

        $constraintViolationList = $this->validator->validate($data);

        if ($constraintViolationList->count() > 0) {
            throw new BadRequestException('Validation failed for request body', 0, new ValidationFailedException($data, $constraintViolationList));
        }

        return [$data];
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        if (!in_array($request->getMethod(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            return false;
        }

        if ('application/json' !== $request->headers->get('Content-Type')) {
            return false;
        }

        if ($argument->isNullable()) {
            return false;
        }

        if ($argument->isVariadic()) {
            return false;
        }

        $attributes = $argument->getAttributes(FromBody::class);

        if (empty($attributes)) {
            return false;
        }

        $type = $argument->getType();

        return null !== $type;
    }
}
