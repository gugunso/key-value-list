<?php

namespace Gugunso\KeyValueList\Definer;

use Gugunso\KeyValueList\Contracts\Definer;

/**
 * Class ArrayDefiner
 *
 * @package Gugunso\KeyValueList\Definer
 */
class ArrayDefiner implements Definer
{
    /**
     * @var array $data
     */
    private $data;

    /**
     * ArrayDefiner constructor.
     *
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->data = $array;
    }

    /**
     * definition
     *
     * @return array
     */
    public function definition(): array
    {
        return $this->data;
    }
}
