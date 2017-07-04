<?php

namespace Selfreliance\Apitokens;

use Illuminate\Support\ServiceProvider;
class ApiTokensServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\Apitokens\ApiTokensController');
        $this->loadViewsFrom(__DIR__.'/views', 'apitoken');
        

        //Публикуем view
        // $this->publishes([
        //     __DIR__.'/views' => resource_path('views/vendor/iusers'),
        // ]);


        //Миграция
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
