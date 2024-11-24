<?

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Spatie\Ignition\Ignition;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface {

    public function boot(): void
    {
        Ignition::make()->setTheme('dark')->register();
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