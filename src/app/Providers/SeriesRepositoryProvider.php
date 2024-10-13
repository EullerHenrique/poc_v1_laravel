<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Repositories\SeriesRepository;
use \App\Repositories\EloquentSeriesRepository;

class SeriesRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #Opção 1
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
    ];
    
    /**
     * Register services.
     */
    #public function register(): void
    #{
        #Opção 2
        ##$this->app->bind(SeriesRepository::class,EloquentSeriesRepository::class);
    #}

    /**
     * Bootstrap services.
     */
    #public function boot(): void
    #{
        //
    #}
}
