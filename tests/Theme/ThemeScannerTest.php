<?php

namespace WTG\Tests\Theme;

use Mockery as m;
use WTG\Theme\ThemeScanner;
use PHPUnit\Framework\TestCase;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Config\Repository as Config;

/**
 * Class ThemeScannerTest
 *
 * @package     WTG\Tests
 * @subpackage  Theme
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class ThemeScannerTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $container = Container::setInstance(new Container);

        $container->singleton('config', function () {
            return $this->createConfig();
        });
    }

    /**
     * @test
     * @return void
     */
    public function normalizesMetadata()
    {
        $fs = m::mock(Filesystem::class);

        $meta = [
            'name' => 'noenoe',
            'author' => 'Some Guy',
            'description' => 'This is a test theme',
            'version' => '1.2.3',
        ];

        $scanner = new ThemeScanner($fs);
        $normalizedMeta = $scanner->normalizeMetadata($meta);

        $this->assertEquals([
            'name' => 'noenoe',
            'author' => 'Some Guy',
            'description' => 'This is a test theme',
            'version' => '1.2.3',
            'license' => ''
        ], $normalizedMeta);
    }

    /**
     * @test
     * @return void
     */
    public function canChangeDefaultScanDirectories()
    {
        $fs = m::mock(Filesystem::class);
        $scanner = new ThemeScanner($fs);
        $startDirs = $scanner->directories;

        $scanner->directories(['blaat']);

        $this->assertNotEquals($startDirs, $scanner->directories);
        $this->assertEquals(['blaat'], $scanner->directories);
    }

    /**
     * @test
     * @return void
     */
    public function parsesMetadataFile()
    {
        $fs = m::mock(Filesystem::class);
        $fs->shouldReceive('get')->andReturn(file_get_contents(__DIR__.'/metadata_test.json'));
        $scanner = new ThemeScanner($fs);

        $meta = $scanner->parseMetadata('./metadata_test.json');

        $this->assertEquals([
            'name' => 'wtg/test',
            'author' => 'Thomas Wiringa',
            'description' => 'Test data',
            'version' => '1.2.3',
            'license' => 'MIT'
        ], $meta);
    }

    /**
     * @test
     * @return void
     * @expectedException \WTG\Theme\InvalidMetadataException
     * @expectedExceptionMessage Invalid theme metadata at './foobar'
     */
    public function throwsExceptionOnInvalidMeta()
    {
        $fs = m::mock(Filesystem::class);
        $fs->shouldReceive('get')->andReturn('invalid json :D');
        $scanner = new ThemeScanner($fs);

        $scanner->parseMetadata('./foobar');
    }

    /**
     * Create a new config repository instance.
     *
     * @return \Illuminate\Config\Repository
     */
    protected function createConfig()
    {
        return new Config([
            'theme' => [
                'paths' => [],
            ],
        ]);
    }
}