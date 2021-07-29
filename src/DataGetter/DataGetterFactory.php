<?php

namespace Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\DataRestoreStrategy;
use Gugunso\KeyValueList\Contracts\HasDefiner;
use Gugunso\KeyValueList\Contracts\ShouldCache;

/**
 * Class DataGetterFactory
 * @package Gugunso\KeyValueList\DataGetter
 */
class DataGetterFactory implements \Gugunso\KeyValueList\Contracts\DataGetterFactory
{
    /** @var HasDefiner $keyValueList */
    private $keyValueList;

    /**
     * DataGetterFactory constructor.
     * @param HasDefiner $keyValueList
     */
    public function __construct(HasDefiner $keyValueList)
    {
        $this->keyValueList = $keyValueList;
    }

    /**
     * factory
     *
     * @return DataRestoreStrategy
     */
    public function build(): DataRestoreStrategy
    {
        $keyValueList = $this->getKeyValueList();
        $definer = $keyValueList->getDefiner();

        //キャッシュ利用のStrategyを優先。
        if (is_a($keyValueList, ShouldCache::class)) {
            return new CacheDataGetter($definer, $keyValueList->getCacheRepository());
        }

        return new DefaultDataGetter($definer);
    }

    /**
     * @return HasDefiner
     */
    private function getKeyValueList(): HasDefiner
    {
        return $this->keyValueList;
    }
}
