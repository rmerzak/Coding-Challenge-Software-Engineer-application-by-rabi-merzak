<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\ProductRepository::class, function ($app) {
            return new \App\Repositories\ProductRepository($app->make(\App\Models\Product::class));
        });
        $this->app->bind(\App\Services\ProductService::class, function ($app) {
            return new \App\Services\ProductService($app->make(\App\Repositories\ProductRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
