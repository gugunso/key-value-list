<?php

namespace Gugunso\KeyValueList\Tests\Definer;

use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Definer\DatabaseKeyValueDefiner;
use Gugunso\KeyValueList\Driver\DatabaseRepository\RawSqlRepository;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Gugunso\KeyValueList\Definer\DatabaseKeyValueDefiner
 * Gugunso\KeyValueList\Tests\Definer\DatabaseKeyValueDefinerTest
 */
class DatabaseKeyValueDefinerTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = DatabaseKeyValueDefiner::class;

    /**
     * @covers ::__construct
     */
    public function test___construct()
    {
        $mockDatabaseRepo = \Mockery::mock(RawSqlRepository::class);
        $targetClass = new $this->testClassName($mockDatabaseRepo, 'keyCol', 'valueCol');
        $this->assertInstanceOf(Definer::class, $targetClass);
    }

    /**
     * @covers ::definition
     */
    public function test_definition()
    {
        $mockDatabaseRepo = \Mockery::mock(RawSqlRepository::class);
        $mockDatabaseRepo->shouldReceive('select')->withNoArgs()->andReturn(
            [
                0 => ['keyCol' => 1, 'valueCol' => 'value1'],
                1 => ['keyCol' => 2, 'valueCol' => 'value2'],
            ]
        );
        $targetClass = new $this->testClassName($mockDatabaseRepo, 'keyCol', 'valueCol');

        $actual = $targetClass->definition();
        $this->assertSame([1 => 'value1', 2 => 'value2'], $actual);
    }
}

