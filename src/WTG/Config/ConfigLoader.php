<?php

namespace WTG\Config;

use Doctrine\ORM\EntityManager;
use WTG\Config\Entities\Config;

/**
 * Config loader.
 *
 * @package     WTG\Config
 * @author      Thomas Wiringa  <thomas.wiinga@gmail.com>
 */
class ConfigLoader
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
    protected function mergeDatabaseConfig()
    {
        $repository = $this->getEntityRepository();
        $configItems = $repository->findAll();
        $config = $this->getConfigRepository();

        foreach ($configItems as $item) {
            $config->set($item->getKey(), $item->getValue());
        }
    }

    /**
     * Get the config entity repository.
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getEntityRepository()
    {
        return $this->em->getRepository(Config::class);
    }

    /**
     * Get the config repository.
     *
     * @return \Illuminate\Config\Repository
     */
    protected function getConfigRepository()
    {
        return app('config');
    }
}