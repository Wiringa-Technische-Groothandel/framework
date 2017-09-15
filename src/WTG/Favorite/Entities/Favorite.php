<?php

namespace WTG\Favorite\Entities;

use Doctrine\ORM\Mapping as ORM;
use WTG\Customer\Entities\Customer;

/**
 * Favorite Entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="favorites")
 * @package     WTG\Favorite
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Favorite
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="WTG\Customer\Entities\Customer")
     * @var Customer
     */
    protected $customer;

    /**
     * @ORM\ManyToOne(targetEntity="WTG\Catalog\Entities\Product")
     * @var Product
     */
    protected $product;

    /**
     * Favorite entity constructor.
     *
     * @param  Customer  $customer
     * @param  Product  $product
     */
    public function __construct(Customer $customer, Product $product)
    {
        $this->customer = $customer;
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}