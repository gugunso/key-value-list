<?php

namespace Tests\Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\DataRestoreStrategy;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\DataGetter\DataGetter;
use PHPUnit\Framework\TestCase;

/**
 * Class CacheDataGetterTest
 * @coversDefaultClass \Gugunso\KeyValueList\DataGetter\DataGetter
 * @package Tests\Gugunso\KeyValueList\DataGetter
 */
class DataGetterTest extends TestCase
{
    protected $testClassName = DataGetter::class;

    /**
     * @covers ::__construct
     */
    public function test___construct()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $targetClass = \Mockery::mock($this->testClassName, [$stubDefiner]);
        $this->assertInstanceOf(DataRestoreStrategy::class, $targetClass);
        $this->assertInstanceOf(DataGetter::class, $targetClass);
    }

    /**
     * @covers ::getDefiner
     */
    public function test_getDefiner()
    {
        $stubDefiner = \Mockery::mock(Definer::class);
        $stubDefiner->shouldReceive('definition')->andReturn([1 => 'one', 2 => 'two']);

        $targetClass = \Mockery::mock($this->testClassName, [$stubDefiner])->makePartial();
        $actual = $targetClass->getDefiner();
        $this->assertSame($stubDefiner, $actual);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}