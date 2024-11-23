<?
require '../vendor/autoload.php';

use Spatie\Ignition\Ignition;
use League\Container\Container;

use App\Core\App;

// error_reporting(0);

$container = new Container();
$container->add('name', function() {
    return 'name 1';
});
var_dump($container->get('name'));
die();

Ignition::make()->setTheme('dark')->register();

$app = new Appp();
$app->run();