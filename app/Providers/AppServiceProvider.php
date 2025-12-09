<?php

namespace App\Providers;
use App\Models\siswa;
use App\Observers\SiswaObserver;

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
        siswa::observe(SiswaObserver::class);
    }
}
