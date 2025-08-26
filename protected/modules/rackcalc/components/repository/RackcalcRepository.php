<?php

/**
 * Class RackcalcRepository
 */
class RackcalcRepository extends CApplicationComponent
{

    /**
     * @param RackcalcBatchForm $form
     * @return int
     */
    public function batchUpdate(RackcalcBatchForm $form, $model)
    {
        $attributes = $form->loadQueryAttributes();

        if (null !== $form->cost) {
            $attributes['cost'] = $this->getPriceQuery(
                'cost',
                $form->cost,
                (int)$form->price_op,
                (int)$form->price_op_unit
            );
        }

        if (count($attributes) === 0) {
            return true;
        }

        $criteria = new CDbCriteria();

        return $model->updateAll($attributes, $criteria);
    }

    /**
     * @param $field
     * @param $price
     * @param $operation
     * @param $unit
     * @return float|CDbExpression
     */
    private function getPriceQuery($field, $price, $operation, $unit)
    {
        if (RackcalcBatchHelper::PRICE_EQUAL === $operation) {
            return $price;
        }

        $sign = RackcalcBatchHelper::PRICE_ADD === $operation ? '+' : '-';

        if (RackcalcBatchHelper::OP_PERCENT === $unit) {
            return new CDbExpression(sprintf('%s %s ((%s / 100) * :percent)', $field, $sign, $field), [
                ':percent' => $price
            ]);
        }

        return new CDbExpression(sprintf('%s %s :price', $field, $sign), [
            ':price' => $price
        ]);
    }
}
