<?php

namespace WTG\Customer\Entities;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use WTG\Support\Concerns\Timestamps;
use LaravelDoctrine\ACL\Mappings as ACL;
use Illuminate\Contracts\Auth\Authenticatable;
use LaravelDoctrine\ORM\Auth\Authenticatable as AuthenticatableTrait;

/**
 * Customer Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="customers")
 * @package     WTG\Customer
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Customer implements Authenticatable
{
    use Timestamps,
        AuthenticatableTrait;

    const CUSTOMER_ROLE_ADMIN = 'admin';
    const CUSTOMER_ROLE_MANAGER = 'manager';
    const CUSTOMER_ROLE_USER = 'user';

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ACL\BelongsToOrganisation(targetEntity="Company")
     * @ORM\ManyToOne(targetEntity="Company")
     * @var Company
     */
    protected $company;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * Customer entity constructor.
     *
     * @param  Company  $company
     * @param  string  $username
     * @param  string  $password
     * @param  string  $email
     * @param  string  $role
     * @param  bool  $active
     */
    public function __construct(Company $company, string $username, string $password, string $email, string $role = self::CUSTOMER_ROLE_ADMIN, bool $active = true)
    {
        $now = Carbon::now();

        $this->company = $company;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->active = $active;
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
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param  string  $username
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param  string  $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param  string  $role
     * @return $this
     */
    public function setRole(string $role)
    {
        $this->role = $role;
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

    public function hasRole()
    {

    }
}