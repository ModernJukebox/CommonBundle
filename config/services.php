<?php
/*
 * This file is part of the ModernJukebox/CommonBundle package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use ModernJukebox\Bundle\Common\Client\Authentication\AuthenticatorFactory;
use ModernJukebox\Bundle\Common\Client\Authentication\AuthenticatorFactoryInterface;
use ModernJukebox\Bundle\Common\Client\Authentication\StrategyFactory;
use ModernJukebox\Bundle\Common\Client\Authentication\StrategyFactoryInterface;
use ModernJukebox\Bundle\Common\Client\ClientFactory;
use ModernJukebox\Bundle\Common\Client\ClientFactoryInterface;
use ModernJukebox\Bundle\Common\Controller\ArgumentResolver\BodyDataValueResolver;
use ModernJukebox\Bundle\Common\EnvVarProcessor\EnvEnvVarProcessor;
use ModernJukebox\Bundle\Common\Messenger\RemoteRequestBusFactory;
use ModernJukebox\Bundle\Common\Messenger\RemoteRequestBusFactoryInterface;
use ModernJukebox\Bundle\Common\Messenger\RemoteResponseBusFactory;
use ModernJukebox\Bundle\Common\Messenger\RemoteResponseBusFactoryInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set('modern_jukebox.common.argument_resolver.body_data', BodyDataValueResolver::class)
        ->args([
            service('serializer'),
            service('validator'),
        ])
        ->tag('controller.argument_value_resolver');

    $services->set('modern_jukebox.common.env_var_processor.env_var', EnvEnvVarProcessor::class)
        ->tag('container.env_var_processor');

    $services->set('modern_jukebox.common.client.authentication.authenticator.factory', AuthenticatorFactory::class);
    $services->alias(
        AuthenticatorFactoryInterface::class,
        'modern_jukebox.common.client.authentication.authenticator.factory'
    )
        ->public();

    $services->set('modern_jukebox.common.client.authentication.strategy.factory', StrategyFactory::class);
    $services->alias(
        StrategyFactoryInterface::class,
        'modern_jukebox.common.client.authentication.strategy.factory'
    )
        ->public();

    $services->set('modern_jukebox.common.client.factory', ClientFactory::class);
    $services->alias(
        ClientFactoryInterface::class,
        'modern_jukebox.common.client.factory'
    )
        ->public();

    $services->set('modern_jukebox.common.messenger.request.factory', RemoteRequestBusFactory::class);
    $services->alias(
        RemoteRequestBusFactoryInterface::class,
        'modern_jukebox.common.messenger.request.factory'
    )
        ->public();

    $services->set('modern_jukebox.common.messenger.response.factory', RemoteResponseBusFactory::class);
    $services->alias(
        RemoteResponseBusFactoryInterface::class,
        'modern_jukebox.common.messenger.response.factory'
    )
        ->public();
};
