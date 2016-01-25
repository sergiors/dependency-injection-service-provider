<?php

namespace Sergiors\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;

class DependencyInjectionServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['di'] = $app->share(function () {
            return new ContainerBuilder();
        });

        $app['di.loader.yml'] = $app->share(function (Application $app) {
            return new YamlFileLoader($app['di'], new FileLocator());
        });

        $app['di.resolver'] = $app->share(function (Application $app) {
            return new LoaderResolver([
                $app['di.loader.yml']
            ]);
        });

        $app['di.loader'] = $app->share(function (Application $app) {
            return new DelegatingLoader($app['di.resolver']);
        });
    }

    public function boot(Application $app)
    {
    }
}
