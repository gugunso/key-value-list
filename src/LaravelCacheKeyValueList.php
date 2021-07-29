<?php

namespace Gugunso\KeyValueList;

use Gugunso\KeyValueList\Contracts\ShouldCache;
use Gugunso\KeyValueList\Traits\CacheWithLaravelTrait;

/**
 * Class LaravelCacheKeyValueList
 * @package Gugunso\KeyValueList
 */
abstract class LaravelCacheKeyValueList extends KeyValueList implements ShouldCache
{
    use CacheWithLaravelTrait;
}
