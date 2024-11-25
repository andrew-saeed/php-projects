<?

use App\Providers\AppServiceProvider;
use App\Providers\RequestServiceProvider;
use App\Providers\RouterServiceProvider;

return [
    'name' => env('AppName'),
    'debug' => env('Debug'),
    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouterServiceProvider::class
    ]
];