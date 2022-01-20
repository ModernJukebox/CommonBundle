<?php
/*
 * This file is part of the ModernJukebox/CommonBundle package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use ModernJukebox\Bundle\Common\Controller\ArgumentResolver\BodyDataValueResolver;
use ModernJukebox\Bundle\Common\EnvVarProcessor\EnvEnvVarProcessor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

return static function (ContainerConfigurator $container) {
    $parameters = $container->parameters();

    $parameters->set('modern_jukebox.common_argument_resolver.namespace', 'App\\Data\\');

    $services = $container->services();

    $services->set('modern_jukebox.common.argument_resolver.body_data', BodyDataValueResolver::class)
        ->arg('$namespace', param('modern_jukebox.common_argument_resolver.namespace'))
        ->tag('controller.argument_value_resolver');

    $services->set('modern_jukebox.common.env_var_processor.env_var', EnvEnvVarProcessor::class)
        ->tag('container.env_var_processor');

};
