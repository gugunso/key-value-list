<?php

namespace Gugunso\KeyValueList;

use Gugunso\KeyValueList\Contracts\ArrayFilterInterface;
use Gugunso\KeyValueList\Contracts\KeyValueListable;
use Gugunso\KeyValueList\Contracts\ShouldCache;
use Gugunso\KeyValueList\Traits\CacheWithLaravelTrait;

/**
 * Class LaravelCacheClassification
 * @package Gugunso\KeyValueList
 * @method KeyValueListable filteredListOf($valueColIndex, ArrayFilterInterface $filter)
 * @method KeyValueListable listOf($valueColIndex)
 * @method InstantClassification filteredClassification(ArrayFilterInterface $filter)
 */
abstract class LaravelCacheClassification extends Classification implements ShouldCache
{
    use CacheWithLaravelTrait;
}
