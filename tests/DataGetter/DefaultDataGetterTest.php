<?php

namespace Tests\Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\DataRestoreStrategy;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\DataGetter\DataGetter;
use Gugunso\KeyValueList\DataGetter\DefaultDataGetter;
use PHPUnit\Framework\TestCase;

/**
 * Class CacheDataGetterTest
 * @coversDefaultClass \Gugunso\KeyValueList\DataGetter\DefaultDataGetter
 * @package Tests\Gugunso\KeyValueList\DataGetter
 */
class DefaultDataGetterTest extends TestCase
{
    protected $testClassName = DefaultDataGetter::class;

    /**
     * @coversNothing
     */
    public function test___construct()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $targetClass = new $this->testClassName($stubDefiner);
        $this->assertInstanceOf(DataRestoreStrategy::class, $targetClass);
        $this->assertInstanceOf(DataGetter::class, $targetClass);
    }

    /**
     * @covers ::restoreData
     */
    public function test_restoreData()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $targetClass = new $this->testClassName($stubDefiner);
        $actual = $targetClass->restoreData();
        $this->assertSame([1 => 'one', 2 => 'two'], $actual);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}