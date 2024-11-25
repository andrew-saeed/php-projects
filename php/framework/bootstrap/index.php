<?
require '../vendor/autoload.php';

use App\Core\App;
use App\Core\Config;
use App\Core\Container;
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

$app = new App($container);

(require('../routes/web.php'))($app->getRouter());

$app->run();