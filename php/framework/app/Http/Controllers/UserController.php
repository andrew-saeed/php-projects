<?

namespace App\Http\Controllers;

use App\Core\Config;
use App\Views\View;
use App\Models\User;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class UserController {

    public function __construct(protected Config $config, protected View $view)
    {
        
    }

    public function __invoke(ServerRequestInterface $request, array $arguments)
    {
        ['user' => $userId] = $arguments;
        $user = User::findOrFail($userId);

        $response = new Response();
        $response->getBody()->write(
            $this->view->render('user.twig', ['user' => $user])
        );
        return $response;
    }
}