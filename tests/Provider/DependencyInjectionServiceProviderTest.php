<?php

namespace Sergiors\Silex\Tests;

use Silex\Application;
use Silex\WebTestCase;
use Sergiors\Silex\Provider\DependencyInjectionServiceProvider;
use Symfony\Component\DependencyInjection\Container;

class DependencyInjectionServiceProviderTest extends WebTestCase
{
    /**
     * @test
     */
    public function register()
    {
        $app = $this->createApplication();
        $app->register(new DependencyInjectionServiceProvider());

        $this->assertInstanceOf(Container::class, $app['di.container']);
    }

    public function createApplication()
    {
        $app = new Application();
        $app['debug'] = true;
        $app['exception_handler']->disable();
        return $app;
    }
}
