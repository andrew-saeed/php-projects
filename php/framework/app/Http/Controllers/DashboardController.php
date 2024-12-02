<?

namespace App\Http\Controllers;

use App\Core\Config;
use App\Views\View;
use Cartalyst\Sentinel\Sentinel;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class DashboardController {

    public function __construct(
        protected Config $config, 
        protected View $view,
        protected Session $session
    ) {}

    public function __invoke(ServerRequestInterface $request, array $arguments)
    {
        $response = new Response();
        $response->getBody()->write(
            $this->view->render('dashboard.twig', [
                'message' => $this->session->getFlashBag()->get('message')[0] ?? ''
            ])
        );
        return $response;
    }
}