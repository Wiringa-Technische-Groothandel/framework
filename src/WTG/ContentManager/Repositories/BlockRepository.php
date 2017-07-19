<?php

namespace WTG\ContentManager\Repositories;

use WTG\ContentManager\Entities\Block;

/**
 * Interface BlockRepository
 *
 * @package     WTG\ContentManager
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface BlockRepository
{
    /**
     * Find a block by its name.
     *
     * @param  string  $name
     * @return Block|null
     */
    public function findByName(string $name);
}