<?php

namespace WTG\Auth;

use WTG\Customer\Entities\Customer;

/**
 * Session guard.
 *
 * @method      Customer  user()
 * @package     WTG\Auth
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class SessionGuard extends \Illuminate\Auth\SessionGuard
{
    /**
     * @var array
     */
    protected $roles = [
        Customer::CUSTOMER_ROLE_ADMIN => [
            Customer::CUSTOMER_ROLE_ADMIN,
            Customer::CUSTOMER_ROLE_MANAGER,
            Customer::CUSTOMER_ROLE_USER
        ],

        Customer::CUSTOMER_ROLE_MANAGER => [
            Customer::CUSTOMER_ROLE_MANAGER,
            Customer::CUSTOMER_ROLE_USER
        ],

        Customer::CUSTOMER_ROLE_USER => [
            Customer::CUSTOMER_ROLE_USER
        ]
    ];

    /**
     * Is the current user an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(Customer::CUSTOMER_ROLE_ADMIN);
    }

    /**
     * Is the current user a manager.
     *
     * @return bool
     */
    public function isManager()
    {
        return $this->hasRole(Customer::CUSTOMER_ROLE_MANAGER);
    }

    /**
     * Check if the current user has the given role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole(string $role)
    {
        if ($this->guest()) {
            return false;
        }

        $userRoles = $this->roles[$this->user()->getRole()] ?? [];

        return in_array($role, $userRoles);
    }
}