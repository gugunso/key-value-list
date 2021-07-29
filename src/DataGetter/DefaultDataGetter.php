<?php

namespace Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\DataRestoreStrategy;

/**
 * Class DefaultDataGetter
 *
 * @package Gugunso\KeyValueList\DataGetter
 */
class DefaultDataGetter extends DataGetter implements DataRestoreStrategy
{
    /**
     * restoreData
     *
     * @return array
     */
    public function restoreData(): array
    {
        return $this->getDefiner()->definition();
    }
}
