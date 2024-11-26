<?

namespace App\Http\Controllers;

use App\Core\Config;
use Laminas\Diactoros\Response;

class HomeController {

    public function __construct(protected Config $config)
    {
        
    }

    public function __invoke()
    {
        $response = new Response();
        $response->getBody()->write("<h1>{$this->config->get('app.name')}</h1>");
        return $response;
    }
}