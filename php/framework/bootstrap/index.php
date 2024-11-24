<?
require '../vendor/autoload.php';

use App\Core\App;
use App\Core\Config;
use App\Core\Container;
use App\Core\Example;
use App\Providers\AppServiceProvider;
use App\Providers\ConfigServiceProvider;
use Dotenv\Dotenv;
use League\Container\ReflectionContainer;

// error_reporting(0);

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = Container::getInstance();
$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new ConfigServiceProvider());
$config = $container->get(Config::class);
$providers = $config->get('app.providers', []);
foreach($providers as $provider) {
    $container->addServiceProvider(new $provider);
}

var_dump($config->get('app.name'));

$app = new Appp();
$app->run();