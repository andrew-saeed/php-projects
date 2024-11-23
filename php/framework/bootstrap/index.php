<?
require '../vendor/autoload.php';

use Spatie\Ignition\Ignition;
use App\Core\App;

// error_reporting(0);

Ignition::make()->setTheme('dark')->register();

$app = new Appp();
$app->run();