<?php

namespace WTG\Support\Contracts;

use Carbon\Carbon;

/**
 * Interface Timestampable
 *
 * @package     WTG\Support
 * @subpackage  Contracts
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface Timestampable
{
    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon;

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon;

    /**
     * @return $this
     */
    public function touch();
}