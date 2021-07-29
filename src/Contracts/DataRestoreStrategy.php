<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * Interface DataRestoreStrategy
 * @package Gugunso\KeyValueList\Contracts
 */
interface DataRestoreStrategy
{
    /**
     * @return array
     */
    public function restoreData(): array;

    /**
     * @return Definer
     */
    public function getDefiner(): Definer;
}
