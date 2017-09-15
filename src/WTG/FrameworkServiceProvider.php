<?php

namespace WTG;

use WTG\Auth\AuthServiceProvider;
use Illuminate\Support\ServiceProvider;
use WTG\Catalog\CatalogServiceProvider;
use WTG\Checkout\CheckoutServiceProvider;
use WTG\Customer\CustomerServiceProvider;
use WTG\Favorite\FavoriteServiceProvider;
use WTG\ContentManager\ContentManagerServiceProvider;

/**
 * Framework service provider.
 *
 * @deprecated  Temp solution until Laravel 5.5
 * @package     WTG
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class FrameworkServiceProvider extends ServiceProvider
{
    /**
     * Boot the provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(CatalogServiceProvider::class);
        $this->app->register(CheckoutServiceProvider::class);
        $this->app->register(ContentManagerServiceProvider::class);
        $this->app->register(CustomerServiceProvider::class);
        $this->app->register(FavoriteServiceProvider::class);
    }
}