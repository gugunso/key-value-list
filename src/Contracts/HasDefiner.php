<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * Interface HasDefiner
 * @package Gugunso\KeyValueList\Contracts
 */
interface HasDefiner
{
    /**
     * @return Definer
     */
    public function getDefiner(): Definer;
}
