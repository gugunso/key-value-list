<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * Interface ArrayFilterInterface
 * @package Gugunso\KeyValueList\Contracts
 */
interface ArrayFilterInterface
{
    /**
     * @param array $row
     * @return bool
     */
    public function arrayFilter(array $row): bool;
}
