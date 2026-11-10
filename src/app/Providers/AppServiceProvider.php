<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cotizacion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // `php artisan serve` (development) drops container env vars that are not
        // whitelisted; TRUSTED_PROXIES comes from docker-compose.yml.
        ServeCommand::$passthroughVariables[] = 'TRUSTED_PROXIES';
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.admin.*', function ($view) {

        $view->with(
            'cotizacionesPendientes',
            Cotizacion::where('estado', 'pendiente')->count()
        );

        });
    }
}
