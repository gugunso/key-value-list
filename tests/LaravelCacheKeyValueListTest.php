<?php

namespace Gugunso\KeyValueList\Tests;

use Gugunso\KeyValueList\Contracts\CacheRepository;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Driver\CacheRepository\LaravelCacheRepository;
use Gugunso\KeyValueList\LaravelCacheKeyValueList;
use Orchestra\Testbench\TestCase;

/**
 * @coversDefaultClass \Gugunso\KeyValueList\LaravelCacheKeyValueList
 * Gugunso\KeyValueList\Tests\LaravelCacheKeyValueListTest
 */
class LaravelCacheKeyValueListTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = LaravelCacheKeyValueList::class;

    /**
     * @covers ::getCacheRepository
     */
    public function test_getCacheRepository()
    {
        $targetClass = new class() extends LaravelCacheKeyValueList {
            public function getDefiner(): Definer
            {
                return ArrayDefiner([]);
            }
        };

        $actual = $targetClass->getCacheRepository();
        $this->assertInstanceOf(CacheRepository::class, $actual);
        $this->assertInstanceOf(LaravelCacheRepository::class, $actual);

        \Closure::bind(
            function () use ($targetClass, $actual) {
                //assertions
                $this->assertSame(get_class($targetClass) . '-cache', $actual->cacheKey);
            },
            $this,
            $actual
        )->__invoke();
    }

}
