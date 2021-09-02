<?php

namespace Gugunso\KeyValueList\Tests\Driver\DatabaseRepository;

use Gugunso\KeyValueList\Contracts\DatabaseRepository;
use Gugunso\KeyValueList\Driver\DatabaseRepository\RawSqlRepository;
use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\TestCase;

/**
 * @coversDefaultClass \Gugunso\KeyValueList\Driver\DatabaseRepository\RawSqlRepository
 * Gugunso\KeyValueList\Tests\Driver\DatabaseRepository\RowSqlRepositoryTest
 */
class RowSqlRepositoryTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = RawSqlRepository::class;

    /**
     *
     */
    public function test__construct()
    {
        $targetClass = new $this->testClassName('select statement.');
        $this->assertInstanceOf(DatabaseRepository::class, $targetClass);
    }

    /**
     * @covers ::select
     */
    public function test_select()
    {
        $targetClass = new $this->testClassName('select statement.');

        $stubPdoStmt = \Mockery::mock(\PDOStatement::class);
        $stubPdoStmt->shouldReceive('execute')->withNoArgs()->once();
        $stubPdoStmt->shouldReceive('fetchAll')->with(\PDO::FETCH_ASSOC)->once()->andReturn(['result']);
        DB::shouldReceive('getPdo->prepare')->with('select statement.')->andReturn($stubPdoStmt);

        $actual = $targetClass->select();
        $this->assertSame(['result'], $actual);
    }

}
