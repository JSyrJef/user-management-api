<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Facades\Schedule;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CorsMiddleware::class,
        // Otros middlewares...
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Otros middlewares del grupo web...
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \App\Http\Middleware\CorsMiddleware::class, // Middleware de CORS
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // Otros middleware...
    //rutas protegidas con el middleware CheckRole
    protected $routeMiddleware = [
        'role' => \App\Http\Middleware\CheckRole::class,
    ];

    //ejecutar el comando artisan para generar estadisticas de usuarios
    protected function schedule(Schedule $schedule)
{
    $schedule->command('generate:user-statistics')->daily();
}
}