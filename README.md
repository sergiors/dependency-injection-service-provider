Dependency Injection Service Provider
-------------------------------------

To see the complete documentation, check out [DependencyInjection](http://symfony.com/doc/current/components/dependency_injection/index.html)

Install
-------
```bash
composer require sergiors/dependency-injection-service-provider "dev-master"
```

How to use
----------
```php
use Silex\Application;
use Sergiors\Silex\Provider\DependencyInjectionServiceProvider;

$app = new Application();
$app->register(new DependencyInjectionServiceProvider());
$app['di.loader']->load('{your config file/dir}');

$app->get('/', function () use ($app) {
    return $app['di.container']->get('{your var}');
});

$app->run();
```

License
-------
MIT
