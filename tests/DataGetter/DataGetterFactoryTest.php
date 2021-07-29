<?php

namespace Tests\Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\CacheRepository;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Contracts\KeyValueListable;
use Gugunso\KeyValueList\Contracts\ShouldCache;
use Gugunso\KeyValueList\DataGetter\CacheDataGetter;
use Gugunso\KeyValueList\DataGetter\DataGetterFactory;
use Gugunso\KeyValueList\DataGetter\DefaultDataGetter;
use PHPUnit\Framework\TestCase;

/**
 * Class DataGetterFactoryTest
 * @package Tests\Gugunso\KeyValueList\DataGetter
 * @coversDefaultClass \Gugunso\KeyValueList\DataGetter\DataGetterFactory
 */
class DataGetterFactoryTest extends TestCase
{
    protected $testClassName = DataGetterFactory::class;

    /**
     * @covers ::__construct
     */
    public function test___construct()
    {
        $mock = \Mockery::mock(KeyValueListable::class);
        $targetClass = new $this->testClassName($mock);
        $this->assertInstanceOf(\Gugunso\KeyValueList\Contracts\DataGetterFactory::class, $targetClass);
    }

    /**
     * @covers ::build
     */
    public function test_build_ShouldCache()
    {
        $mockShouldCache = \Mockery::mock(KeyValueListable::class, ShouldCache::class);
        $mockDefiner = \Mockery::mock(Definer::class)->shouldIgnoreMissing()->asUndefined();
        $mockCacheRepository = \Mockery::mock(CacheRepository::class)->shouldIgnoreMissing()->asUndefined();

        $mockShouldCache->shouldReceive('getDefiner')->once()->andReturn($mockDefiner);
        $mockShouldCache->shouldReceive('getCacheRepository')->once()->andReturn($mockCacheRepository);

        $targetClass = new $this->testClassName($mockShouldCache);
        $actual = $targetClass->build();
        $this->assertInstanceOf(CacheDataGetter::class, $actual);
    }

    /**
     * @covers ::build
     */
    public function test_build_Default()
    {
        $mockShouldCache = \Mockery::mock(KeyValueListable::class);
        $mockDefiner = \Mockery::mock(Definer::class)->shouldIgnoreMissing()->asUndefined();
        $mockShouldCache->shouldReceive('getDefiner')->once()->andReturn($mockDefiner);

        $targetClass = new $this->testClassName($mockShouldCache);
        $actual = $targetClass->build();
        $this->assertInstanceOf(DefaultDataGetter::class, $actual);
    }

    /**
     * @covers ::getKeyValueList
     */
    public function test_getKeyValueList()
    {
        $mock = \Mockery::mock(KeyValueListable::class);
        $targetClass = new $this->testClassName($mock);

        //テスト対象メソッドの実行
        \Closure::bind(
            function () use ($targetClass, $mock) {
                $actual = $targetClass->getKeyValueList();
                //assertions
                $this->assertInstanceOf(KeyValueListable::class, $actual);
                $this->assertSame($mock, $actual);
            },
            $this,
            $targetClass
        )->__invoke();
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}