<?
require '../vendor/autoload.php';

use League\Container\Container;

use App\Core\App;
use App\Providers\AppServiceProvider;

// error_reporting(0);

$container = new Container();
$container->addServiceProvider(new AppServiceProvider());
var_dump($container->get('name'));

$app = new App();
$app->run();