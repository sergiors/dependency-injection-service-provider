<?php

namespace Sergiors\Silex\Tests;

use Pimple\Container;
use Sergiors\Silex\Provider\DependencyInjectionServiceProvider;
use Symfony\Component\DependencyInjection\Container as SymfonyContainer;

class DependencyInjectionServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function register()
    {
        $container = new Container();
        $container->register(new DependencyInjectionServiceProvider());

        $this->assertInstanceOf(SymfonyContainer::class, $container['di.container']);
        $this->assertTrue($container['di.loader']->supports('test.xml'));
        $this->assertTrue($container['di.loader']->supports('test.yml'));
        $this->assertTrue($container['di.loader']->supports('test.ini'));
        $this->assertTrue($container['di.loader']->supports('test.php'));
        $this->assertTrue($container['di.loader']->supports('test/'));
    }
}
