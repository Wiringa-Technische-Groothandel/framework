<?php

namespace WTG\Config;

use Illuminate\Config\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Config loader interface.
 *
 * @package     WTG\Config
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
interface ConfigLoaderInterface
{
    /**
     * Load the config.
     *
     * @return void
     */
    public function load();

    /**
     * Merge the settings from the database with the loaded config.
     *
     * @return void
     */
    public function mergeDatabaseConfig();

    /**
     * Get the config items from the database.
     *
     * @return array
     */
    public function getDatabaseItems(): array;

    /**
     * Get the config entity repository.
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getEntityRepository(): EntityRepository;

    /**
     * Get the config repository.
     *
     * @return \Illuminate\Config\Repository
     */
    public function getConfigRepository(): Repository;
}