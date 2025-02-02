<?

namespace App\Providers;

use App\Core\Config;
use App\Views\TwigExtension;
use App\Views\TwigRuntimeLoader;
use App\Views\View;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class ViewServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface {

    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->getContainer()->add(View::class, function() {

            $debug = $this->getContainer()->get(Config::class)->get('app.debug');
            $loader = new FilesystemLoader(__DIR__ . '/../../resources/views');
            $twig = new Environment($loader, [
                'cache' => false,
                'debug' => $debug
            ]);

            $twig->addRuntimeLoader(new TwigRuntimeLoader($this->getContainer()));
            $twig->addExtension(new TwigExtension());
            
            if($debug) {
                $twig->addExtension(new DebugExtension());
            }
            return new View($twig);

        })->setShared(true);
    }

    public function provides(string $id): bool
    {
        $services = [
            View::class
        ];
        
        return in_array($id, $services);
    }
}