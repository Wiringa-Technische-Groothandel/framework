<?php

namespace WTG\Checkout\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use WTG\Support\Concerns\Timestamps;

/**
 * OrderItem Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="order_items")
 * @package     WTG\Checkout
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class OrderItem
{
    use Timestamps;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Order")
     */
    protected $order;

    /**
     * @ORM\Column(type="string", length=7)
     */
    protected $sku;

    /**
     * @ORM\Column(type="decimal", length=8, precision=2)
     */
    protected $price;

    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $qty;

    /**
     * @ORM\Column(type="decimal", length=8, precision=2)
     */
    protected $subtotal;

    /**
     * OrderItem entity constructor.
     *
     * @param  Order  $order
     * @param  string  $sku
     * @param  float  $price
     * @param  string  $qty
     * @param  float  $subtotal
     */
    public function __construct(Order $order, string $sku, float $price, string $qty, float $subtotal)
    {
        $now = Carbon::now();

        $this->order = $order;
        $this->sku = $sku;
        $this->price = $price;
        $this->qty = $qty;
        $this->subtotal = $subtotal;
        $this->created_at = $now;
        $this->updated_at = $now;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getQty(): string
    {
        return $this->qty;
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }
}