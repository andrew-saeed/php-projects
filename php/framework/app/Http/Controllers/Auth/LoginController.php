<?

namespace App\Http\Controllers\Auth;

use App\Core\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class LoginController {

    public function __construct(
        protected Config $config, 
        protected View $view,
        protected Sentinel $auth) {}

    public function index()
    {   
        $response = new Response();
        $response->getBody()->write(
            $this->view->render('auth/login.twig')
        );
        return $response;
    }

    public function store(ServerRequestInterface $request)
    {
        if(!$this->auth->authenticate($request->getParsedBody())) {
            
            return new Response\RedirectResponse('/signin');
        }

        return new Response\RedirectResponse('/dashboard');
    }

    public function destroy()
    {
        $this->auth->logout();

        return new Response\RedirectResponse('/');
    }
}