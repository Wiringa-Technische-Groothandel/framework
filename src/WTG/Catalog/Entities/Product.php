<?php

namespace WTG\Catalog\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use WTG\Support\Concerns\Timestamps;
use WTG\Support\Contracts\Timestampable;

/**
 * Product Entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="products")
 * @package     WTG\Favorite
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Product implements Timestampable
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
     * @ORM\Column(type="string", length=10)
     */
    protected $sku;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $alt_sku;

    /**
     * @ORM\Column(name="`group`", type="string", length=10)
     */
    protected $group;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $registered_per;

    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $packed_per;

    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $price_per;

    /**
     * @ORM\Column(type="integer")
     */
    protected $refactor;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $ean;

    public function __construct(
        string $name,
        string $sku,
        string $group,
        string $alt_sku,
        string $registered_per,
        string $packed_per,
        string $price_per
    ) {
        $now = Carbon::now();

        $this->name = $name;
        $this->sku = $sku;
        $this->group = $group;
        $this->alt_sku = $alt_sku;
        $this->registered_per = $registered_per;
        $this->packed_per = $packed_per;
        $this->price_per = $price_per;

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
}