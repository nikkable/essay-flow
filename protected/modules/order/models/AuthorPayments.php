<?php
/**
 * @property integer $author_id
 * @property string $cart_number
 * @property string $cart_name
 * @property string $currency
 * @property integer $hold
 * @property integer $paid
 */

use yupe\widgets\YPurifier;

Yii::import('application.modules.other.OtherModule');

/**
 * Class Order
 */
class AuthorPayments extends yupe\models\YModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{store_author_payments}}';
    }

    /**
     * @param null|string $className
     * @return $this
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['cart_number, cart_name', 'filter', 'filter' => 'trim'],
            ['cart_number, cart_name', 'filter', 'filter' => [$obj = new YPurifier(), 'purify']],
            ['author_id', 'required'],
            [
                'author_id, hold, paid',
                'numerical',
                'integerOnly' => true,
            ],
            ['author_id, hold, paid', 'store\components\validators\NumberValidator'],
            ['cart_name', 'length', 'max' => 30],
            ['cart_number', 'length', 'max' => 19],
            ['expiry_month, expiry_year', 'length', 'max' => 2],
            ['currency', 'length', 'max' => 3],
            [
                'author_id cart_number, cart_name, currency, paid, hold, expiry_month, expiry_year',
                'safe',
                'on' => 'search',
            ],
        ];
    }

    /**
     * @return array
     */
    public function relations()
    {
        return [
            'author' => [self::BELONGS_TO, 'User', 'author_id'],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'CTimestampBehavior' => [
                'class' => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => true,
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            ],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'author_id' => Yii::t('OtherModule.other', 'Author Id'),
            'cart_number' => Yii::t('OtherModule.other', 'Cart number'),
            'cart_name' => Yii::t('OtherModule.other', 'Cardholder name'),
            'currency' => Yii::t('OtherModule.other', 'Currency'),
            'hold' => Yii::t('OtherModule.other', 'Hold'),
            'paid' => Yii::t('OtherModule.other', 'Paid'),
            'expiry_month' => Yii::t('OtherModule.other', 'Expiry month'),
            'expiry_year' => Yii::t('OtherModule.other', 'Expiry year'),
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('t.author_id', $this->author_id);
        $criteria->compare('t.cart_number', $this->cart_number, true);
        $criteria->compare('t.cart_name', $this->cart_name, true);
        $criteria->compare('t.currency', $this->currency, true);
        $criteria->compare('t.hold', $this->hold, true);
        $criteria->compare('t.paid', $this->paid, true);
        $criteria->compare('t.paid', $this->expiry_month, true);
        $criteria->compare('t.paid', $this->expiry_year, true);

        return new CActiveDataProvider(
            __CLASS__, [
                'criteria' => $criteria,
                'sort' => ['defaultOrder' => $this->getTableAlias() . '.author_id DESC'],
            ]
        );
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    /**
     * @return bool
     * @TODO вынести всю логику в saveData
     */
    public function beforeSave()
    {
        return parent::beforeSave();
    }

    /**
     *
     */
    public function afterDelete()
    {
        parent::afterDelete();
    }

    /**
     *
     */
    public function afterSave()
    {
        parent::afterSave();
    }

    public static function getPriceTotalWithCommission($total)
    {
        return round($total * ((100 - Yii::app()->getModule('order')->commission) / 100), 2);
    }

    public static function getAccumulationInfo()
    {
        $query = "
            WITH ap AS (
                SELECT 
                    author_id,
                    SUM(paid) AS paid,
                    SUM(hold) AS hold
                FROM yupe_store_author_payments
                WHERE author_id = :id
                GROUP BY author_id
            )
            SELECT 
                COUNT(CASE WHEN status_id = :status_finish THEN id END) AS ordersFinished,
                COUNT(CASE WHEN status_id != :status_finish AND status_id != :status_accepted THEN id END) AS ordersInWork,
                round(ap.paid * :currencyCoff, 2) AS pricePaid,
                round(ap.hold * :currencyCoff, 2) AS priceHold
            FROM yupe_store_order AS t
            LEFT JOIN ap ON ap.author_id = t.author_id
            WHERE t.author_id = :id
            GROUP BY t.author_id
        ";

        $command = Yii::app()->db->createCommand($query);
        $command->bindValues([
            ':id' => Yii::app()->getUser()->getId(),
            ':status_finish' => OrderStatus::STATUS_FINISHED,
            ':status_accepted' => OrderStatus::STATUS_ACCEPTED,
            ':currencyCoff' => Yii::app()->controller->currencyCoff
        ]);

        $accumulation = $command->queryRow();

        $orders = Order::model()->findAllByAttributes(['author_id' => Yii::app()->getUser()->getId()]);

        // Итоговая цена
        foreach ($orders as $order) {
            if($order->status_id == OrderStatus::STATUS_FINISHED) {
                $accumulation['priceTotal'] += $order->getTotalPriceWithDelivery();
            }
        }

        $accumulation['priceTotal'] = round($accumulation['priceTotal'] * Yii::app()->controller->currencyCoff, 2);

        $accumulation['priceTotalWithCommission'] = round(AuthorPayments::getPriceTotalWithCommission($accumulation['priceTotal']), 2);
        $accumulation['commission'] = $accumulation['priceTotal'] - $accumulation['priceTotalWithCommission'];

        // Доступно к выводу
        $accumulation['available'] = $accumulation['priceTotalWithCommission'] - ($accumulation['pricePaid'] + $accumulation['priceHold']);

        return $accumulation;
    }
}
