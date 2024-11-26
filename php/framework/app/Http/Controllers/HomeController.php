<?

namespace App\Http\Controllers;

use App\Core\Config;
use App\Views\View;
use Illuminate\Database\DatabaseManager;
use Laminas\Diactoros\Response;

class HomeController {

    public function __construct(protected Config $config, protected View $view, protected DatabaseManager $databaseManager)
    {
        
    }

    public function __invoke()
    {
        $response = new Response();
        $response->getBody()->write(
            $this->view->render('home.twig', [
                'name' => $this->config->get('app.name'),
                'users' => $this->databaseManager->table('users')->get()
            ])
        );
        return $response;
    }
}