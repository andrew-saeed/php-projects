<?

use App\Providers\AppServiceProvider;
use App\Providers\RequestServiceProvider;
use App\Providers\RouterServiceProvider;
use App\Providers\ViewServiceProvider;
use App\Providers\DatabaseServiceProvider;
use App\Providers\AuthServiceProvider;
use App\Providers\CsrfServiceProvider;
use App\Providers\SessionServiceProvider;

return [
    'name' => env('AppName'),
    'debug' => env('Debug'),
    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouterServiceProvider::class,
        ViewServiceProvider::class,
        DatabaseServiceProvider::class,
        AuthServiceProvider::class,
        CsrfServiceProvider::class,
        SessionServiceProvider::class
    ]
];