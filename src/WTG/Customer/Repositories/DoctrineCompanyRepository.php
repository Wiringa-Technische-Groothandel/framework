<?php

namespace WTG\Customer\Repositories;

use Doctrine\ORM\EntityRepository;
use WTG\Customer\Entities\Company;

/**
 * Doctrine company repository.
 *
 * @package     WTG\Customer
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class DoctrineCompanyRepository extends EntityRepository implements CompanyRepository
{
    /**
     * Find a block by its customer_number.
     *
     * @param  string  $customerNumber
     * @return Company|null
     */
    public function findByCustomerNumber(string $customerNumber)
    {
        /** @var Company $company */
        $company = $this->findOneBy(['customer_number' => $customerNumber]);

        return $company;
    }
}