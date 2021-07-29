<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * DatabaseRepository
 *
 * @package Gugunso\KeyValueList\Contracts
 */
interface DatabaseRepository
{
    /**
     * @param string $sql
     * @return array
     */
    public function select(string $sql): array;
}
