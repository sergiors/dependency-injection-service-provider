<?php

namespace Sergiors\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;

/**
 * @author Sérgio Rafael Siqueira <sergio@inbe.com.br>
 */
class DependencyInjectionServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['di.container'] = function () use ($app) {
            return new ContainerBuilder(new ParameterBag($app['di.parameters']));
        };

        $app['di.loader.yml'] = $app->factory(function (Container $app) {
            return new YamlFileLoader($app['di.container'], new FileLocator());
        });

        $app['di.loader.xml'] = $app->factory(function (Container $app) {
            return new XmlFileLoader($app['di.container'], new FileLocator());
        });

        $app['di.resolver'] = function () use ($app) {
            return new LoaderResolver([
                $app['di.loader.yml'],
                $app['di.loader.xml']
            ]);
        };

        $app['di.loader'] = function () use ($app) {
            return new DelegatingLoader($app['di.resolver']);
        };

        $app['di.parameters'] = [];
    }
}
