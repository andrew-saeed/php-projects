<?

namespace App\Providers;

use App\Core\Config;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface {

    public function boot(): void
    {
        if($this->container->get(Config::class)->get('app.debug')) {
            Ignition::make()->setTheme('dark')->register();
        }
    }

    public function register(): void
    {
        //
    }

    public function provides(string $id): bool
    {
        $services = [
            //
        ];
        
        return in_array($id, $services);
    }
}