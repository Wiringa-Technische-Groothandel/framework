<?php

namespace WTG\Customer\Repositories;

use Doctrine\ORM\EntityRepository;
use WTG\Customer\Entities\Company;
use WTG\Customer\Entities\Customer;

/**
 * Doctrine customer repository.
 *
 * @package     WTG\Customer
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class DoctrineCustomerRepository extends EntityRepository implements CustomerRepository
{
    /**
     * Find a customer by its username.
     *
     * @param  string  $username
     * @return Customer|null
     */
    public function findByUsername(string $username)
    {
        /** @var Customer $customer */
        $customer = $this->findOneBy(['username' => $username]);

        return $customer;
    }

    /**
     * Find customers by their company id.
     *
     * @param  Company  $company
     * @return array
     */
    public function findByCompany(Company $company)
    {
        $customers = $this->findBy([
            'company' => $company->getId()
        ]);

        return $customers;
    }
}