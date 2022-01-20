<?php
/*
 * This file is part of the ModernJukebox/CommonBundle package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ModernJukebox\Bundle\Common\EnvVarProcessor;

use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;

class EnvEnvVarProcessor implements EnvVarProcessorInterface
{
    public function getEnv(string $prefix, string $name, \Closure $getEnv): mixed
    {
        if ('dev' === $prefix) {
            return 'dev' === $getEnv($name);
        }

        if ('prod' === $prefix) {
            return 'prod' === $getEnv($name);
        }

        return false;
    }

    public static function getProvidedTypes(): array
    {
        return [
            'dev' => 'bool',
            'prod' => 'bool',
        ];
    }
}
