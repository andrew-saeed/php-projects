<?

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

class RouterServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface {

    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->getContainer()->add(Router::class, function() {

            $router = new Router();

            $router->setStrategy(
                (new ApplicationStrategy())->setContainer($this->getContainer())
            );

            return $router;
        })->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            Router::class
        ];
        
        return in_array($id, $services);
    }
}