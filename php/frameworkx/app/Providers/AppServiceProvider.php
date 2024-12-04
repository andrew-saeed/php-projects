<?

namespace App\Providers;

use App\Core\Config;
use App\Views\View;
use Illuminate\Pagination\Paginator;
use Laminas\Diactoros\Request;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Respect\Validation\Factory;
use Spatie\Ignition\Ignition;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface {

    public function boot(): void
    {
        if($this->container->get(Config::class)->get('app.debug')) {
            Ignition::make()->setTheme('dark')->register();
        }

        Factory::setDefaultInstance(
            (new Factory)->withRuleNamespace('App\\Validations\Rules')
            ->withExceptionNamespace('App\\Validations\\Exceptions')
        );

        Paginator::currentPathResolver(function () {
            return strtok($this->getContainer()->get(Request::class)->getUri(), '?');
        });

        Paginator::queryStringResolver(function () {
            return $this->getContainer()->get(Request::class)->getQueryParams();
        });

        Paginator::currentPageResolver(function(string $pageName='page') {
            return $this->getContainer()->get(Request::class)->getQueryParams()[$pageName] ?? 1;
        });

        Paginator::viewFactoryResolver(function() {
            return $this->getContainer()->get(View::class);
        });

        Paginator::defaultView('components/pagination.twig');
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