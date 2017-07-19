<?php

namespace WTG\Customer\Repositories;

use WTG\Customer\Entities\Company;
use WTG\Customer\Entities\Customer;

/**
 * Customer repository interface.
 *
 * @package     WTG\Customer
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface CustomerRepository
{
    /**
     * Find a block by its customer_number.
     *
     * @param  string  $username
     * @return Customer|null
     */
    public function findByUsername(string $username);

    /**
     * Find customers by their company id.
     *
     * @param  Company  $company
     * @return array
     */
    public function findByCompany(Company $company);
}