<?php

namespace Tmaic\Tmiac;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tmaic-sku.php', 'tmaic-sku');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/tmaic-sku.php' => config_path('tmaic-sku.php')
            ], 'tmaic-sku-config');

            $this->publishes([
                __DIR__.'/../database/migrations/create_tmaic_sku_tables.php.stub' => $this->getMigrationFileName()
            ], 'tmaic-sku-migrations');
        }
    }

    protected function getMigrationFileName()
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) {
                return (new Filesystem)->glob($path.'*_create_tmaic_sku_tables.php');
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_create_tmaic_sku_tables.php")
            ->first();
    }
}