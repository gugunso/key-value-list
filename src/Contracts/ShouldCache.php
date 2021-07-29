<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * Interface ShouldCache
 * @package Gugunso\KeyValueList\Contracts
 */
interface ShouldCache
{
    /**
     * @return CacheRepository
     */
    public function getCacheRepository(): CacheRepository;
}
