<?php

/**
 * Class RackcalcBatchForm
 */
class RackcalcBatchForm extends CFormModel
{
    /**
     * @var float
     */
    public $cost;

    /**
     * @var int
     */
    public $price_op;

    /**
     * @var int
     */
    public $price_op_unit;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['price_op, price_op_unit', 'numerical', 'integerOnly' => true],
            ['price_op', 'in', 'range' => array_keys(RackcalcBatchHelper::getPericeOpList())],
            ['price_op_unit', 'in', 'range' => array_keys(RackcalcBatchHelper::getOpUnits())],
            ['cost', 'store\components\validators\NumberValidator'],
            ['cost', 'default', 'value' => null],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'cost' => 'Price',
        ];
    }

    /**
     * @return array
     */
    public function loadQueryAttributes()
    {
        $result = [];
        $allowed = [];
        $attributes = $this->getAttributes();

        foreach ($attributes as $name => $value) {
            if (in_array($name, $allowed) && null !== $value) {
                $result[$name] = $value;
            }
        }

        return $result;
    }
}