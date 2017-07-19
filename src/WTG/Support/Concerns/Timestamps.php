<?php

namespace WTG\Support\Concerns;

use Carbon\Carbon;

/**
 * Timestamps concern.
 *
 * @package     WTG\Support
 * @subpackage  Concerns
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
trait Timestamps
{
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

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

    /**
     * @return $this
     */
    public function touch()
    {
        $this->updated_at = Carbon::now();
        return $this;
    }
}