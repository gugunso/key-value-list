<?php

namespace Gugunso\KeyValueList\Tests\Driver\DatabaseRepository;

use Gugunso\KeyValueList\Contracts\DatabaseRepository;
use Gugunso\KeyValueList\Driver\DatabaseRepository\EloquentBuilderRepository;
use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Gugunso\KeyValueList\Driver\DatabaseRepository\EloquentBuilderRepository
 * Gugunso\KeyValueList\Tests\Driver\DatabaseRepository\EloquentBuilderRepositoryTest
 */
class EloquentBuilderRepositoryTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = EloquentBuilderRepository::class;

    /**
     * @covers ::__construct
     */
    public function test___construct()
    {
        $builder = \Mockery::mock(Builder::class);
        $targetClass = new $this->testClassName($builder);
        $this->assertInstanceOf(DatabaseRepository::class, $targetClass);
    }

    /**
     * @covers ::select
     */
    public function test_select()
    {
        $builder = \Mockery::mock(Builder::class);
        $builder->shouldReceive('get->toArray')->withNoArgs()->andReturn([1, 2, 3]);
        $targetClass = new $this->testClassName($builder);
        $actual = $targetClass->select();
        $this->assertSame([1, 2, 3], $actual);
    }
}
