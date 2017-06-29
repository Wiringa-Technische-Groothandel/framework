<?php

namespace WTG\Config\Console;

use Illuminate\Console\Command;
use Doctrine\ORM\EntityManagerInterface;
use WTG\Config\Entities\Config;

/**
 * Store config command.
 *
 * @package     WTG\Config
 * @subpackage  Console
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class StoreConfigCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'config:store {--f|force : Overwrite existing settings}';

    /**
     * @var string
     */
    protected $description = 'Store values from config files in the database';

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * StoreConfigCommand constructor.
     *
     * @param  EntityManagerInterface  $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    /**
     * Command handler.
     *
     * @return void
     */
    public function handle()
    {
        $config = array_dot(config()->all());

        foreach ($config as $key => $value) {
            $configItem = new Config(
                $key,
                $value
            );

            $this->em->persist($configItem);
        }

        $this->em->flush();

        $this->output->success('Cant touch this!');
    }
}