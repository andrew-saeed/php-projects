<?

namespace App\Http\Controllers\Auth;

use App\Core\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\Session\Session;
use Respect\Validation\Validator as v;

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
            $this->view->render('auth/login.twig', [
                'errors' => $this->session->getFlashBag()->get('errors')[0] ?? null
            ])
        );
        return $response;
    }

    public function store(ServerRequestInterface $request)
    {
        try {
            v::key('email', v::email()->notEmpty())
                ->key('password', v::notEmpty())
                ->assert($request->getParsedBody());
        } catch(ValidationException $e) {
            $this->session->getFlashBag()->add('errors', $e->getMessages());
            return new Response\RedirectResponse('/signin');
        }

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