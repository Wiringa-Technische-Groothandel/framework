<?php

namespace WTG\Config\Entities;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping AS ORM;

/**
 * Config entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="config")
 * @package     WTG\Config
 * @subpackage  Entities
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class Config
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ORM\Column(name="`key`", type="string", length=255, unique=true)
     */
    protected $key;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $value;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    /**
     * Config constructor.
     *
     * @param  string  $key
     * @param  mixed  $value
     */
    public function __construct(string $key, $value)
    {
        $now = Carbon::now();

        $this->key = $key;
        $this->value = json_encode($value);
        $this->created_at = $now;
        $this->updated_at = $now;
    }

    /**
     * @return \Ramsey\Uuid\Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return json_decode($this->value, true);
    }

    /**
     * @return void
     */
    public function setValue($value): void
    {
        $this->value = json_encode($value);
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->created_at);
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->updated_at);
    }
}