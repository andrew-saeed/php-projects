<?

use League\Route\Router;
use Laminas\Diactoros\Response;

return static function(Router $router) {

    $router->get('/', function() {
        $response = new Response();
        $response->getBody()->write('<h1>Home Page</h1>');
        return $response;
    });

    $router->get('/about', function() {
        $response = new Response();
        $response->getBody()->write('<h1>About Page</h1>');
        return $response;
    });
};