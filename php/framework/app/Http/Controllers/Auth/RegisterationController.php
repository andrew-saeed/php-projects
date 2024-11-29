<?

namespace App\Http\Controllers\Auth;

use App\Core\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class RegisterationController {

    public function __construct(
        protected Config $config, 
        protected View $view,
        protected Sentinel $auth) {}

    public function index()
    {   
        $response = new Response();
        $response->getBody()->write(
            $this->view->render('auth/register.twig')
        );
        return $response;
    }

    public function store(ServerRequestInterface $request, array $arguments)
    {
        if($user = $this->auth->registerAndActivate($request->getParsedBody())) {
            $this->auth->login($user);
        }

        return new Response\RedirectResponse('/dashboard');
    }
}