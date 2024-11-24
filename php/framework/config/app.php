<?

use App\Providers\AppServiceProvider;

return [
    'name' => env('AppName'),
    'debug' => env('Debug'),
    'providers' => [
        AppServiceProvider::class,
    ]
];