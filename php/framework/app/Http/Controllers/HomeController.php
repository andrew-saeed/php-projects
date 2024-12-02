<?

namespace App\Http\Controllers;

use App\Core\Config;
use App\Views\View;
use App\Models\User;
use Laminas\Diactoros\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController {

    public function __construct(
        protected Config $config, 
        protected View $view,
        protected Session $session
    ) {}

    public function __invoke()
    {
        $response = new Response();
        $response->getBody()->write(
            $this->view->render('home.twig', [
                'users' => User::get(),
                'message' => $this->session->getFlashBag()->get('message')[0] ?? ''
            ])
        );
        return $response;
    }
}