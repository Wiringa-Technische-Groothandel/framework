<?php

namespace WTG\Customer;

use Doctrine\DBAL\Types\Type;
use WTG\Customer\Entities\Company;
use WTG\Customer\Entities\Customer;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;
use LaravelDoctrine\ACL\AclServiceProvider;
use LaravelDoctrine\ORM\DoctrineServiceProvider;
use WTG\Customer\Repositories\CompanyRepository;
use WTG\Customer\Repositories\CustomerRepository;
use WTG\Customer\Repositories\DoctrineCompanyRepository;
use WTG\Customer\Repositories\DoctrineCustomerRepository;

/**
 * Customer service provider.
 *
 * @package     WTG\Customer
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(AclServiceProvider::class);

        if (!Type::hasType('uuid')) {
            Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
        }

        $doctrineManager = $this->app->make(DoctrineManager::class);
        $doctrineManager->addPaths([
            __DIR__.'/Entities'
        ]);

        $this->app->bind(CompanyRepository::class, function ($app) {
            return new DoctrineCompanyRepository(
                $app['em'],
                $app['em']->getClassMetaData(Company::class)
            );
        });

        $this->app->bind(CustomerRepository::class, function ($app) {
            return new DoctrineCustomerRepository(
                $app['em'],
                $app['em']->getClassMetaData(Customer::class)
            );
        });
    }
}