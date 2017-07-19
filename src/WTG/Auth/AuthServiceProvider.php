<?php

namespace WTG\Auth;

use Illuminate\Support\ServiceProvider;

/**
 * Auth service provider.
 *
 * @package     WTG\Auth
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('auth', function ($app) {
            // Once the authentication service has actually been requested by the developer
            // we will set a variable in the application indicating such. This helps us
            // know that we need to set any queued cookies in the after event later.
            $app['auth.loaded'] = true;
            return new AuthManager($app);
        });
    }
}