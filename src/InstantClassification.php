<?php

namespace Gugunso\KeyValueList;

use Gugunso\KeyValueList\Contracts\ArrayFilterInterface;
use Gugunso\KeyValueList\Contracts\Definer;
use Gugunso\KeyValueList\Contracts\HasDefiner;
use Gugunso\KeyValueList\Contracts\KeyValueListable;

/**
 * Class InstantClassification
 * 定義をコンストラクタで与えて一時的に作成するClassification
 * Class LaravelCacheClassification
 * @package Gugunso\KeyValueList
 * @method KeyValueListable filteredListOf($valueColIndex, ArrayFilterInterface $filter)
 * @method KeyValueListable listOf($valueColIndex)
 * @method InstantClassification filteredClassification(ArrayFilterInterface $filter)
 * @method array getData()
 */
class InstantClassification extends Classification implements HasDefiner
{
    /** @var Definer $definer */
    private $definer;
    /** @var string|int $keyCoIndex */
    private $identityIndex;

    /**
     * InstantClassification constructor.
     * @param Definer $definer
     * @param string|int $identityIndex
     */
    public function __construct(Definer $definer, $identityIndex)
    {
        $this->definer = $definer;
        $this->identityIndex = $identityIndex;
    }

    /**
     * @return Definer
     */
    public function getDefiner(): Definer
    {
        return $this->definer;
    }

    /**
     * @return int|string
     */
    protected function getIdentityIndex()
    {
        return $this->identityIndex;
    }
}
