<?

use League\Route\Router;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

return static function(Router $router) {

    $router->get('/', HomeController::class);
    $router->get('/users/{user}', UserController::class);
    $router->get('/dashboard', DashboardController::class);
    $router->get('/signup', [RegisterationController::class, 'index']);
    $router->post('/signup', [RegisterationController::class, 'store']);
};