<?

namespace App\Http\Controllers;

use App\Core\Config;
use App\Views\View;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController {

    public function __construct(protected Config $config, protected View $view)
    {
        
    }

    public function __invoke(ServerRequestInterface $request, array $arguments)
    {
        $response = new Response();
        $response->getBody()->write(
            $this->view->render('dashboard.twig')
        );
        return $response;
    }
}