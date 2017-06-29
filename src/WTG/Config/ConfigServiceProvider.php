<?php

namespace WTG\Config;

use Illuminate\Support\ServiceProvider;

/**
 * Config service provider.
 *
 * @package     WTG\Config
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(\LaravelDoctrine\ORM\DoctrineServiceProvider::class);

        $this->commands([
            Console\StoreConfigCommand::class
        ]);
    }

    /**
     * Register the service provider
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind('config', ConfigRepository::class);
    }
}