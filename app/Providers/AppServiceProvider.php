<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider; // Pastikan ServiceProvider diimpor dengan benar
use App\Events\TicketCreated;
use App\Listeners\NotifyAdminTicketCreated;
use Illuminate\Support\Facades\Event;

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
        // Mendaftarkan event dan listener
        // Event::listen(TicketCreated::class, NotifyAdminTicketCreated::class);
    }
}
