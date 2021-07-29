<?php

namespace Tests\Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\CacheRepository;
use Gugunso\KeyValueList\Contracts\DataRestoreStrategy;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\DataGetter\CacheDataGetter;
use Gugunso\KeyValueList\DataGetter\DataGetter;
use PHPUnit\Framework\TestCase;

/**
 * Class CacheDataGetterTest
 * @coversDefaultClass \Gugunso\KeyValueList\DataGetter\CacheDataGetter
 * @package Tests\Gugunso\KeyValueList\DataGetter
 */
class CacheDataGetterTest extends TestCase
{
    protected $testClassName = CacheDataGetter::class;

    /**
     * @covers ::__construct
     */
    public function test___construct()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $mockCacheRepository = \Mockery::mock(CacheRepository::class);
        $targetClass = new $this->testClassName($stubDefiner, $mockCacheRepository);
        $this->assertInstanceOf(DataRestoreStrategy::class, $targetClass);
        $this->assertInstanceOf(DataGetter::class, $targetClass);
    }

    /**
     * @covers ::restoreData
     */
    public function test_restoreData_FromCache()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $mockCacheRepository = \Mockery::mock(CacheRepository::class);
        $mockCacheRepository->shouldReceive('get')->once()->andReturn(
            [
                1 => 'cache returns value1',
                2 => 'cache returns value2',
            ]
        );
        $targetClass = new $this->testClassName($stubDefiner, $mockCacheRepository);
        $actual = $targetClass->restoreData();
        $this->assertSame(
            [
                1 => 'cache returns value1',
                2 => 'cache returns value2',
            ],
            $actual
        );
    }

    /**
     * @covers ::restoreData
     */
    public function test_restoreData_FromCallable()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $mockCacheRepository = \Mockery::mock(CacheRepository::class);
        $mockCacheRepository->shouldReceive('get')->once()->andReturn([]);
        $mockCacheRepository->shouldReceive('store')->with([1 => 'one', 2 => 'two'])->once();

        $targetClass = new $this->testClassName($stubDefiner, $mockCacheRepository);
        $actual = $targetClass->restoreData();
        $this->assertSame([1 => 'one', 2 => 'two'], $actual);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}