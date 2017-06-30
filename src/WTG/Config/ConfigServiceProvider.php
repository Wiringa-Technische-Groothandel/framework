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
        \Doctrine\DBAL\Types\Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');

        $this->app->register(\LaravelDoctrine\ORM\DoctrineServiceProvider::class);

        $this->commands([
            Console\StoreConfigCommand::class
        ]);

        $this->loadDatabaseConfigValues();
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

    /**
     * Load config values from the database.
     *
     * @return void
     */
    protected function loadDatabaseConfigValues()
    {
        /** @var ConfigLoader $configLoader */
        $configLoader = $this->app->make(ConfigLoader::class);

        $configLoader->load();
    }
}