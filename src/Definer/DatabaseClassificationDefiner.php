<?php

namespace Gugunso\KeyValueList\Definer;

use Gugunso\KeyValueList\Contracts\DatabaseRepository;
use Gugunso\KeyValueList\Contracts\Definer;

/**
 * Class SqlDefiner
 *
 * @package Gugunso\KeyValueList\Definer
 */
class DatabaseClassificationDefiner implements Definer
{
    /**
     * @var DatabaseRepository $repository
     */
    private $repository;

    /**
     * SqlDefiner constructor.
     *
     * @param DatabaseRepository $repository
     */
    public function __construct(DatabaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * definition
     *
     * @return array
     */
    public function definition(): array
    {
        return $this->repository->select();
    }
}
