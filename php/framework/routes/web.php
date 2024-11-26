<?

use League\Route\Router;
use App\Http\Controllers\HomeController;

return static function(Router $router) {

    $router->get('/', HomeController::class);
};