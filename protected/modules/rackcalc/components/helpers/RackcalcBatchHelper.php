<?php

/**
 * Class RackcalcBatchHelper
 */
class RackcalcBatchHelper
{
    /**
     *
     */
    const PRICE_EQUAL = 0;

    /**
     *
     */
    const PRICE_ADD = 1;

    /**
     *
     */
    const PRICE_SUB = 2;

    /**
     *
     */
    const OP_UNIT = 0;

    /**
     *
     */
    const OP_PERCENT = 1;

    /**
     * @return array
     */
    public static function getPericeOpList()
    {
        return [
            self::PRICE_EQUAL => 'equal',
            self::PRICE_ADD => 'increase by',
            self::PRICE_SUB => 'decrease by',
        ];
    }

    /**
     * @return array
     */
    public static function getOpUnits()
    {
        return [
            self::OP_UNIT => 'units',
            self::OP_PERCENT => '%',
        ];
    }
}