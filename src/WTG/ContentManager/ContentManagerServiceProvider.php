<?php

namespace WTG\ContentManager;

use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\Blade;
use WTG\ContentManager\Entities\Block;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineManager;
use LaravelDoctrine\ORM\DoctrineServiceProvider;
use WTG\ContentManager\Repositories\BlockRepository;
use WTG\ContentManager\Repositories\DoctrineBlockRepository;

/**
 * Content manager service provider.
 *
 * @package     WTG\ContentManager
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class ContentManagerServiceProvider extends ServiceProvider
{
    /**
     * @var BlockRepository
     */
    protected $blockRepository;

    protected $defer = true;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(BlockRepository $blockRepository)
    {
        $this->blockRepository = $blockRepository;

        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'contentmanager');

        Blade::directive('block', function (string $blockName) {
            return "<?php echo block($blockName); ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(DoctrineServiceProvider::class);

        if (!Type::hasType('uuid')) {
            Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');
        }

        $doctrineManager = $this->app->make(DoctrineManager::class);
        $doctrineManager->addPaths([
            __DIR__.'/Entities'
        ]);

        $this->app->bind(BlockRepository::class, function ($app) {
            return new DoctrineBlockRepository(
                $app['em'],
                $app['em']->getClassMetaData(Block::class)
            );
        });
    }
}