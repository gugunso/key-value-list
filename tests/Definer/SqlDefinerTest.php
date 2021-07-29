<?php

namespace Tests\Gugunso\KeyValueList\Definer;

use Gugunso\KeyValueList\Contracts\DatabaseRepository;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Definer\SqlDefiner;
use PHPUnit\Framework\TestCase;

/**
 * Class SqlDefinerTest
 * @package Tests\Gugunso\KeyValueList\SqlDefiner
 * @coversDefaultClass \Gugunso\KeyValueList\Definer\SqlDefiner
 */
class SqlDefinerTest extends TestCase
{
    protected $testClassName = SqlDefiner::class;

    /**
     * @covers ::__construct
     */
    public function test___construct()
    {
        $argumentSql = 'SELECT something FROM nice_table';
        $mockDatabaseRepo = \Mockery::mock(DatabaseRepository::class);
        $targetClass = new $this->testClassName($argumentSql, $mockDatabaseRepo);
        $this->assertInstanceOf(Definer::class, $targetClass);
        return $targetClass;
    }

    /**
     * @covers ::definition
     */
    public function test_definition()
    {
        $argumentSql = 'SELECT something FROM nice_table';
        $mockDatabaseRepo = \Mockery::mock(DatabaseRepository::class);
        $mockDatabaseRepo->shouldReceive('select')->with($argumentSql)->andReturn(
            [0 => [0 => 'result', 1 => 'of', 2 => 'query']]
        );
        $targetClass = new $this->testClassName($argumentSql, $mockDatabaseRepo);

        $actual = $targetClass->definition();
        $this->assertSame([0 => [0 => 'result', 1 => 'of', 2 => 'query']], $actual);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}