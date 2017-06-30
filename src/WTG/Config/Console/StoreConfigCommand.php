<?php

namespace WTG\Config\Console;

use Illuminate\Console\Command;
use WTG\Config\Entities\Config;
use Doctrine\ORM\EntityManagerInterface;

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
    protected $signature = 'config:store {key : Config key} {value : String value} {--f|force : Overwrite existing settings}';

    /**
     * @var string
     */
    protected $description = 'Store config values in the database';

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
        $key = $this->argument('key');
        $value = $this->argument('value');

        $configItem = new Config(
            $key,
            $value
        );

        $this->em->persist($configItem);
        $this->em->flush();

        $this->output->success("Config value '$key' set!");
    }
}