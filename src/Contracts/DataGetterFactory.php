<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * Interface DataGetterFactory
 * @package Gugunso\KeyValueList\Contracts
 */
interface DataGetterFactory
{
    /**
     * @return DataRestoreStrategy
     */
    public function build(): DataRestoreStrategy;
}
