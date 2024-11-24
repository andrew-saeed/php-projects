<?
require '../vendor/autoload.php';

use App\Core\App;
use App\Core\Config;
use App\Core\Container;
use App\Core\Example;
use App\Providers\AppServiceProvider;
use App\Providers\ConfigServiceProvider;

use League\Container\ReflectionContainer;

// error_reporting(0);

$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new AppServiceProvider());
$container->addServiceProvider(new ConfigServiceProvider());
var_dump($container->get(Config::class)->get('config.app.name', 'default framework'));

$app = new App();
$app->run();