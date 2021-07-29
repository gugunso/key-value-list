<?php

namespace Gugunso\KeyValueList\Contracts;

/**
 * Interface BehaveAsKeyValueList
 * @package Gugunso\KeyValueList\Contracts
 */
interface BehaveAsKeyValueList extends KeyValueListable
{
    /**
     * @return KeyValueListable
     */
    public function representativeList(): KeyValueListable;
}
