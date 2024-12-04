<?

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\FlashOldData;
use App\Http\Middleware\RedirectIfAuth;
use App\Http\Middleware\RedirectIfGuest;
use League\Route\Router;
use League\Route\RouteGroup;
use Psr\Container\ContainerInterface;

return static function(Router $router, ContainerInterface $container) {

    $router->middleware($container->get('csrf'));
    $router->middleware(new FlashOldData());
    
    $router->get('/', HomeController::class);
    $router->get('/users/{user}', UserController::class);

    $router->group('/', function(RouteGroup $route) {
        $route->get('/dashboard', DashboardController::class);
        $route->post('/signout', [LoginController::class, 'destroy']);
    })->middleware(new RedirectIfGuest());

    $router->group('/', function(RouteGroup $route) {
        $route->get('/signup', [RegisterationController::class, 'index']);
        $route->post('/signup', [RegisterationController::class, 'store']);
        $route->get('/signin', [LoginController::class, 'index']);
        $route->post('/signin', [LoginController::class, 'store']);
    })->middleware(new RedirectIfAuth());
    
};