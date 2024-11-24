<?
require '../vendor/autoload.php';

use App\Core\App;
use App\Core\Container;
use App\Core\Example;
use App\Providers\AppServiceProvider;

use League\Container\ReflectionContainer;

// error_reporting(0);

$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new AppServiceProvider());
var_dump(Container::getInstance()->get(Example::class));

$app = new App();
$app->run();