<?
require '../vendor/autoload.php';

use App\Core\App;
use App\Core\Example;
use App\Providers\AppServiceProvider;

use League\Container\Container;
use League\Container\ReflectionContainer;

// error_reporting(0);

$container = new Container();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new AppServiceProvider());
var_dump($container->get(Example::class));

$app = new App();
$app->run();