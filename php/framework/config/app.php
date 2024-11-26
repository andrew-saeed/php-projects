<?

use App\Providers\AppServiceProvider;
use App\Providers\RequestServiceProvider;
use App\Providers\RouterServiceProvider;
use App\Providers\ViewServiceProvider;

return [
    'name' => env('AppName'),
    'debug' => env('Debug'),
    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouterServiceProvider::class,
        ViewServiceProvider::class
    ]
];