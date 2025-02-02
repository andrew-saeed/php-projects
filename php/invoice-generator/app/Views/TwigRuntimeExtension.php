<?php

namespace App\Views;

use App\Core\Config;
use RuntimeException;
use Cartalyst\Sentinel\Sentinel;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig\Extension\AbstractExtension;

class TwigRuntimeExtension extends AbstractExtension
{
    public function __construct(protected ContainerInterface $container) {}

    public function config()
    {
        return $this->container->get(Config::class);
    }

    public function auth()
    {
        return $this->container->get(Sentinel::class);
    }

    public function csrf()
    {
        $guard = $this->container->get('csrf');

        return '
            <input type="hidden" name="' . $guard->getTokenNameKey() . '" value="' . $guard->getTokenName() . '">
            <input type="hidden" name="' . $guard->getTokenValueKey() . '" value="' . $guard->getTokenValue() . '">
        ';
    }

    public function session()
    {
        return $this->container->get(Session::class);
    }

    public function old(string $key) 
    {
        return $this->session()->getFlashBag()->peek('old')[$key] ?? null;
    }

    public function vite()
    {
        $links = null;
        $development = $this->config()->get('app.debug');
        if($development) {
            $links = '
                <script type="module" src="http://localhost:4200/@vite/client"></script>
                <link rel="stylesheet" href="http://localhost:4200/resources/css/index.scss">
                <script src="http://localhost:4200/resources/js/index.js"></script>
            ';
        } else {
            // Read the JSON file
            $jsonContent = file_get_contents(dirname(__DIR__) . '/../public/dist/manifest.json');

            if ($jsonContent === false) {
                throw new RuntimeException("Unable to read 'manifest.json'.");
            }

            // Convert JSON to associative array
            $dataArray = json_decode($jsonContent, true, 512, JSON_THROW_ON_ERROR);

            // Use the array
            foreach ($dataArray as $asset) {
                // Only process entry files
                if (!isset($asset['isEntry']) || !$asset['isEntry']) {
                    continue;
                }
                
                // Get the output file name
                $file = $asset['file'];
                
                // Determine the file extension (e.g., css or js)
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                
                if ($ext === 'css') {
                    $links .= '<link rel="stylesheet" href="/dist/' . $file . '">' . PHP_EOL;
                } elseif ($ext === 'js') {
                    $links .= '<script type="module" src="/dist/' . $file . '"></script>' . PHP_EOL;
                }
            }
        }

        return $links;
    }
}