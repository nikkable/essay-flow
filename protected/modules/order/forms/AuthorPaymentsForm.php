<?php

Yii::import('application.modules.other.OtherModule');

/**
 **/
class AuthorPaymentsForm extends yupe\models\YFormModel
{
    /**
     * @var string
     */
    public $cart_number;
    /**
     * @var string
     */
    public $cart_name;
    /**
     * @var string
     */
    public $currency;
    /**
     * @var float
     */
    public $sum;
    /**
     * @var array
     */
    public $accumulation;
    /**
     * @var string
     */
    public $expiry_month;
    /**
     * @var string
     */
    public $expiry_year;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            // Основные обязательные поля
            ['cart_number, cart_name, sum, currency, expiry_month, expiry_year', 'required'],
            // Валидация суммы
            ['sum', 'store\components\validators\NumberValidator'],
            ['sum', 'numerical', 'min' => 1, 'message' => Yii::t('OtherModule.other', 'Amount > 0.')],

            // Валидация номера карты
            ['cart_number', 'match', 'pattern' => '/^[0-9]{16,19}$/', 'message' => Yii::t('OtherModule.other', 'Card number must be 16-19 digits.')],
            ['cart_number', 'length', 'min' => 16, 'max' => 19],

            // Валидация имени держателя карты
            ['cart_name', 'length', 'min' => 1, 'max' => 30],
            ['cart_name', 'match', 'pattern' => '/^[a-zA-Z\s\.\-]{1,30}$/', 'message' => Yii::t('OtherModule.other', 'Cardholder name can only contain letters, spaces, dots, and hyphens.')],

            // Валидация месяца и года истечения срока действия
            ['expiry_month', 'match', 'pattern' => '/^(0?[1-9]|1[0-2])$/', 'message' => Yii::t('OtherModule.other', 'Expiry month must be a valid month (1-12).')],
            ['expiry_year', 'match', 'pattern' => '/^[0-9]{2}$/', 'message' => Yii::t('OtherModule.other', 'Expiry year must be 2 digits.')],
            ['expiry_month, expiry_year', 'validateExpiryDate'],

            // Валидация валюты
            ['currency', 'length', 'max' => 3],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'cart_number' => Yii::t('OtherModule.other', 'Cart number'),
            'cart_name' => Yii::t('OtherModule.other', 'Cardholder name'),
            'sum' => Yii::t('OtherModule.other', 'Amount'),
            'currency' => Yii::t('OtherModule.other', 'Currency'),
            'expiry_month' => Yii::t('OtherModule.other', 'Expiry month'),
            'expiry_year' => Yii::t('OtherModule.other', 'Expiry year'),
        ];
    }

    /**
     * Custom validator for expiry date.
     * @param string $attribute the name of the attribute to be validated.
     * @param array $params additional parameters for the validator.
     */
    public function validateExpiryDate($attribute, $params)
    {
        if (empty($this->expiry_month) || empty($this->expiry_year)) {
            return;
        }

        $currentYear = (int)date('y');
        $currentMonth = (int)date('n');

        $expMonth = (int)$this->expiry_month;
        $expYear = (int)$this->expiry_year;

        if ($expYear < $currentYear) {
            $this->addError($attribute, Yii::t('OtherModule.other', 'Card has expired.'));
            return;
        }

        if ($expYear === $currentYear && $expMonth < $currentMonth) {
            $this->addError($attribute, Yii::t('OtherModule.other', 'Card has expired.'));
            return;
        }
    }

    public function beforeValidate()
    {
        // Если запрашиваемая сумма больше доступных средств (Сумма выполненных заказов - Сумма выплат)
        if($this->sum > $this->accumulation['available']) {
            $this->addError('sum', Yii::t('OtherModule.other', 'Amount > paid.'));
        }

        return parent::beforeValidate();
    }
}
