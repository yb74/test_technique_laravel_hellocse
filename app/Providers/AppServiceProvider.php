<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Checks if a database is connected and displays its name
        // try {
        //     \DB::connection()->getPDO();
        //     dump('Database connected: ' . \DB::connection()->getDatabaseName());
        // }
         
        // catch (\Exception $e) {
        //     dump('Database connected: ' . 'None');
        // }
    }
}
