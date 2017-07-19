<?php

namespace WTG;

use WTG\Support\Stub;
use WTG\Auth\AuthServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use WTG\Customer\CustomerServiceProvider;
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
    protected $quote;

    /**
     * Boot the provider.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: Remove this from here
        View::composer('*', function ($view) {
            if (auth()->check()) {
                if ($this->quote === null) {
                    $this->quote = new Stub();
                }

                $view->with('quote', $this->quote);
            }
        });

        $this->app->register(CustomerServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(ContentManagerServiceProvider::class);
    }
}