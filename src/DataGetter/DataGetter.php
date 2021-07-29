<?php

namespace Gugunso\KeyValueList\DataGetter;

use Gugunso\KeyValueList\Contracts\DataRestoreStrategy;
use Gugunso\KeyValueList\Contracts\Definer;

/**
 * DataGetter
 *
 * @package Gugunso\KeyValueList\DataGetter
 */
abstract class DataGetter implements DataRestoreStrategy
{

    /** @var Definer $definer */
    private $definer;

    /**
     * DataGetter constructor.
     * @param Definer $definer
     */
    public function __construct(Definer $definer)
    {
        $this->definer = $definer;
    }

    /**
     * @return Definer
     */
    public function getDefiner(): Definer
    {
        return $this->definer;
    }
}
