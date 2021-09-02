<?php

namespace Gugunso\KeyValueList\Definer;

use Gugunso\KeyValueList\Contracts\DatabaseRepository;
use Gugunso\KeyValueList\Contracts\Definer;

/**
 * Class SqlKeyValueDefiner
 * @package Gugunso\KeyValueList\Definer
 */
class DatabaseKeyValueDefiner implements Definer
{
    /** @var DatabaseRepository $repository */
    private $repository;
    /** @var string $sql */
    private $key;
    /** @var string $sql */
    private $value;

    /**
     * SqlKeyValueDefiner constructor.
     * @param DatabaseRepository $repository
     * @param string $key
     * @param string $value
     */
    public function __construct(DatabaseRepository $repository, string $key, string $value)
    {
        $this->repository = $repository;
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function definition(): array
    {
        $result = [];
        $selected = $this->repository->select();

        foreach ($selected as $row) {
            $key = $row[$this->key];
            $result[$key] = $row[$this->value];
        }
        return $result;
    }
}
