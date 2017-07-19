<?php

namespace WTG\Customer\Repositories;

use WTG\Customer\Entities\Company;

/**
 * Company repository interface.
 *
 * @package     WTG\Customer
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface CompanyRepository
{
    /**
     * Find a block by its customer_number.
     *
     * @param  string  $customerNumber
     * @return Company|null
     */
    public function findByCustomerNumber(string $customerNumber);
}