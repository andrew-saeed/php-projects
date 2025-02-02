<?

namespace App\Core;

use App\Exceptions\ExceptionHandler;
use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use League\Route\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

class App {

    protected Router $router;
    protected ServerRequestInterface $request;

    public function __construct(protected ContainerInterface $container) {

        $this->router = $this->container->get(Router::class);
        $this->request = $this->container->get(Request::class);
    }

    public function getRouter(): Router {

        return $this->router;
    }

    public function run():void {

        $response = new Response();

        try {
            
            $response = $this->router->dispatch($this->request);
        } catch(\Throwable $e) {

            $response = $this->container->get(ExceptionHandler::class)->handle($this->request, $response, $e);
        }
        
        (new SapiEmitter())->emit($response);
    }
}