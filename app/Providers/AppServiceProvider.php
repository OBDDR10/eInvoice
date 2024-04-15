<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // Gate::before(function ($user) {
        //     if(get_class($user) == 'App\Models\Admin')
        //         return $user->hasRole('Technical') ? true : null;
        // });
    }
}
