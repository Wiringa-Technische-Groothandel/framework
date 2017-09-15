<?php

namespace WTG\Catalog\Repositories;

use WTG\Catalog\Entities\Product;
use Doctrine\ORM\EntityRepository;

/**
 * Doctrine company repository.
 *
 * @package     WTG\Customer
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class DoctrineProductRepository extends EntityRepository implements ProductRepository
{
    /**
     * Find a company by its customer_number.
     *
     * @param  string  $sku
     * @return Product|null
     */
    public function findBySku(string $sku)
    {
        /** @var Product $product */
        $product = $this->findOneBy([
            'sku' => $sku
        ]);

        return $product;
    }
}