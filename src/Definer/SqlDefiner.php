<?php

namespace Gugunso\KeyValueList\Definer;

use Gugunso\KeyValueList\Contracts\DatabaseRepository;
use Gugunso\KeyValueList\Contracts\Definer;

/**
 * Class SqlDefiner
 *
 * @package Gugunso\KeyValueList\Definer
 */
class SqlDefiner implements Definer
{
    /**
     * @var DatabaseRepository $repository
     */
    private $repository;
    /**
     * @var string $sql
     */
    private $sql;

    /**
     * SqlDefiner constructor.
     *
     * @param string             $sql
     * @param DatabaseRepository $repository
     */
    public function __construct(string $sql, DatabaseRepository $repository)
    {
        $this->repository = $repository;
        $this->sql = $sql;
    }

    /**
     * definition
     *
     * @return array
     */
    public function definition(): array
    {
        return $this->repository->select($this->sql);
    }
}
