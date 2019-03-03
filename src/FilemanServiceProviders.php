<?php

namespace Dizytech\Fileman;


use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class FilemanServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'fileman');
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/dizytech/fileman'),
            
        ], 'public');
        $this->publishes([
            __DIR__.'/config/fileman.php' => config_path('fileman.php')
        ], 'config');
        
       
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/fileman.php','fileman');
    }
}