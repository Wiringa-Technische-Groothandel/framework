<?php

namespace WTG\Catalog\Repositories;

use WTG\Catalog\Entities\Product;

/**
 * Product repository interface.
 *
 * @package     WTG\Catalog
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface ProductRepository
{
    /**
     * Find a product by its sku.
     *
     * @param  string  $sku
     * @return Product|null
     */
    public function findBySku(string $sku);
}