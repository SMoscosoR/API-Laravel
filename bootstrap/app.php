<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            // Rutas para API principal
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rutas web (vistas HTML)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Rutas para autenticación
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/auth.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Si necesitas middlewares globales, agrégalos aquí.
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        // Personalización del manejo de excepciones
    })
    ->create();