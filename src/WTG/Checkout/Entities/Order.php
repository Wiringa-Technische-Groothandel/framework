<?php

namespace WTG\Checkout\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use WTG\Customer\Entities\Company;
use WTG\Support\Concerns\Timestamps;

/**
 * Order Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="orders")
 * @package     WTG\Checkout
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Order
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
     * @ORM\ManyToOne(targetEntity="WTG\Customer\Entities\Company")
     */
    protected $company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $comment;

    /**
     * Order entity constructor.
     *
     * @param  Company  $company
     * @param  string|null  $comment
     * @param  Carbon|null  $created_at
     */
    public function __construct(Company $company, string $comment = null, Carbon $created_at = null)
    {
        $now = Carbon::now();

        $this->company = $company;
        $this->comment = $comment;
        $this->created_at = $created_at ?: $now;
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
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}