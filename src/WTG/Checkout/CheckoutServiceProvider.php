<?php

namespace WTG\Checkout;

use WTG\Support\Stub;
use Doctrine\DBAL\Types\Type;
use WTG\Checkout\Entities\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;

/**
 * Checkout service provider.
 *
 * @package     WTG\Customer
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class CheckoutServiceProvider extends ServiceProvider
{
    /**
     * @var
     */
    protected $quote;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        View::composer('*', function ($view) {
            if (auth()->check()) {
                if ($this->quote === null) {
                    $this->quote = new Stub();
                }

                $view->with('quote', $this->quote);
            }
        });
    }

    /**
     * Register the service provider.
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

//        $this->app->bind(OrderRepository::class, function ($app) {
//            return new DoctrineOrderRepository(
//                $app['em'],
//                $app['em']->getClassMetaData(Order::class)
//            );
//        });
    }
}