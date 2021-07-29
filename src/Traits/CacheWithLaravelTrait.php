<?php

namespace Gugunso\KeyValueList\Traits;

use Gugunso\KeyValueList\Contracts\CacheRepository;
use Gugunso\KeyValueList\Driver\CacheRepository\LaravelCacheRepository;

/**
 * Class CacheWithLaravelTrait
 * @package Gugunso\KeyValueList\Traits
 */
trait CacheWithLaravelTrait
{
    /**
     * @return CacheRepository
     */
    public function getCacheRepository(): CacheRepository
    {
        return new LaravelCacheRepository(static::class . '-cache');
    }
}
