<?php

namespace WTG\Catalog;

use Doctrine\DBAL\Types\Type;
use WTG\Catalog\Entities\Product;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;
use WTG\Catalog\Repositories\ProductRepository;
use WTG\Catalog\Repositories\DoctrineProductRepository;

/**
 * Catalog service provider.
 *
 * @package     WTG\Catalog
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class CatalogServiceProvider extends ServiceProvider
{
    /**
     * Boot the provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the provider.
     *
     * @return void
     */
    public function register()
    {
        if (!Type::hasType('uuid')) {
            Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
        }

        $doctrineManager = $this->app->make(DoctrineManager::class);
        $doctrineManager->addPaths([
            __DIR__.'/Entities'
        ]);

        $this->app->bind(ProductRepository::class, function ($app) {
            return new DoctrineProductRepository(
                $app['em'],
                $app['em']->getClassMetaData(Product::class)
            );
        });
    }
}