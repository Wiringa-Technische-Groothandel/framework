<?php

namespace WTG\ContentManager\Repositories;

use Doctrine\ORM\EntityRepository;
use WTG\ContentManager\Entities\Block;

/**
 * Doctrine block repository.
 *
 * @package     WTG\ContentManager
 * @subpackage  Repositories
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class DoctrineBlockRepository extends EntityRepository implements BlockRepository
{
    /**
     * Find a block by its name.
     *
     * @param  string  $name
     * @return Block|null
     */
    public function findByName(string $name)
    {
        /** @var Block $block */
        $block = $this->findOneBy(['name' => $name]);

        return $block;
    }
}