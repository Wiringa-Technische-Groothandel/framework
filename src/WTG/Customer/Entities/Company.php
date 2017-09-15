<?php

namespace WTG\Customer\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use WTG\Support\Concerns\Timestamps;
use WTG\Support\Contracts\Timestampable;
use LaravelDoctrine\ACL\Contracts\Organisation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Company Entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="companies")
 * @package     WTG\Customer
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Company implements Organisation, Timestampable
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
     * @ORM\Column(type="string", unique=true)
     */
    protected $customer_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $postcode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $city;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted;

    /**
     * @ORM\OneToMany(targetEntity="Customer", mappedBy="company")
     * @var ArrayCollection|Customer[]
     */
    protected $customers;

    /**
     * Company constructor.
     *
     * @param  string  $customerNumber
     * @param  string  $name
     * @param  string  $street
     * @param  string  $postcode
     * @param  string  $city
     * @param  bool  $active
     * @param  bool  $deleted
     */
    public function __construct(string $customerNumber, string $name, string $street, string $postcode, string $city, bool $active = false, bool $deleted = false)
    {
        $now = Carbon::now();

        $this->customer_number = $customerNumber;
        $this->name = $name;
        $this->street = $street;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->active = $active;
        $this->deleted = $deleted;
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
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return $this->customer_number;
    }

    /**
     * @param  string  $customerNumber
     * @return $this
     */
    public function setCustomerNumber(string $customerNumber)
    {
        $this->customer_number = $customerNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param  string  $street
     * @return $this
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param  string  $postcode
     * @return $this
     */
    public function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param  string  $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param  bool  $active
     * @return $this
     */
    public function setActive(bool $active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param  bool  $deleted
     * @return $this
     */
    public function setDeleted(bool $deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }
}