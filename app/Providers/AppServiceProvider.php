<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Pagination\Paginator;


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
    Paginator::useBootstrapFive();
    if ($this->app->runningInConsole()) {
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('db:backup')->everyMinute(); // testing cepat

            // nanti ganti jadi:
            // $schedule->command('db:backup')->weeklyOn(1, '02:00');
        });
    }
}

}
