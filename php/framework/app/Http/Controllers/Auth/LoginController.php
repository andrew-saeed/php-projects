<?

namespace App\Http\Controllers\Auth;

use App\Core\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController {

    public function __construct(
        protected Config $config, 
        protected View $view,
        protected Sentinel $auth,
        protected Session $session
    ) {}

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

        $this->session->getFlashBag()->add('message', 'welcome back');

        return new Response\RedirectResponse('/dashboard');
    }

    public function destroy()
    {
        $this->auth->logout();

        $this->session->getFlashBag()->add('message', 'goodbye');

        return new Response\RedirectResponse('/');
    }
}