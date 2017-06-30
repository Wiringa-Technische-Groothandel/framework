<?php

namespace WTG\Config;

use WTG\Config\Entities\Config;
use Doctrine\ORM\EntityManager;
use Illuminate\Config\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * Config loader.
 *
 * @package     WTG\Config
 * @author      Thomas Wiringa  <thomas.wiinga@gmail.com>
 */
class ConfigLoader implements ConfigLoaderInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * ConfigLoader constructor.
     *
     * @param  EntityManager  $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Load the config.
     *
     * @return void
     */
    public function load()
    {
        $this->mergeDatabaseConfig();
    }

    /**
     * Merge the settings from the database with the loaded config.
     *
     * @return void
     */
    public function mergeDatabaseConfig()
    {
        $configItems = $this->getDatabaseItems();
        $config = $this->getConfigRepository();

        foreach ($configItems as $item) {
            $config->set($item->getKey(), $item->getValue());
        }
    }

    /**
     * Get the config items from the database.
     *
     * @return array
     */
    public function getDatabaseItems(): array
    {
        $repository = $this->getEntityRepository();

        return $repository->findAll();
    }

    /**
     * Get the config entity repository.
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getEntityRepository(): EntityRepository
    {
        return $this->em->getRepository(Config::class);
    }

    /**
     * Get the config repository.
     *
     * @return \Illuminate\Config\Repository
     */
    public function getConfigRepository(): Repository
    {
        return app('config');
    }
}