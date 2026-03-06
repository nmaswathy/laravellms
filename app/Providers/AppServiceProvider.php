<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\NewUserCreatedEvent;
use App\Listeners\WelcomeMailListener;
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
        \Illuminate\Pagination\Paginator::useBootstrapFive();
        Event::listen(
            NewUserCreatedEvent::class,
            WelcomeMailListener::class,
        );
    }
}
