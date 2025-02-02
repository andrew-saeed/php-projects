<?

namespace App\Http\Controllers\Auth;

use App\Core\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class RegisterationController {

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
            $this->view->render('auth/register.twig', [
                'errors' => $this->session->getFlashBag()->get('errors')[0] ?? null
            ])
        );
        return $response;
    }

    public function store(ServerRequestInterface $request, array $arguments)
    {
        try {
            v::key('first_name', v::alpha()->notEmpty())
                ->key('email', v::email()->notEmpty()->not(v::existsInDatabase('users', 'email')))
                ->key('password', v::notEmpty())
                ->assert($request->getParsedBody());
        } catch(ValidationException $e) {
            $this->session->getFlashBag()->add('errors', $e->getMessages());
            return new Response\RedirectResponse('/signup');
        }

        if($user = $this->auth->registerAndActivate($request->getParsedBody())) {
            $this->auth->login($user);
        }

        return new Response\RedirectResponse('/dashboard');
    }
}