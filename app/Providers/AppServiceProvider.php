<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\TicketCreated;
use App\Listeners\NotifyAdminTicketCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS pada production
        URL::forceScheme('https');

        // Mendaftarkan event dan listener
        // Event::listen(TicketCreated::class, NotifyAdminTicketCreated::class);
    }
}