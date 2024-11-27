<?

use League\Route\Router;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

return static function(Router $router) {

    $router->get('/', HomeController::class);
    $router->get('/users/{user}', UserController::class);
};