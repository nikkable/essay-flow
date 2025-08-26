<?php
/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $status
 * @property integer $coff
 */

class Currency extends yupe\models\YModel
{

    /**
     *  Статус - черновик
     */
    const STATUS_DRAFT = 0;
    /**
     *  Статус - опубликовано
     */
    const STATUS_PUBLISHED = 1;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{currency}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, slug', 'filter', 'filter' => 'trim'],
            ['name, slug', 'required', 'on' => ['update', 'insert']],
            ['status', 'numerical', 'integerOnly' => true],
            ['coff', 'length', 'max' => 6],
            ['name', 'length', 'max' => 150],
            ['slug', 'length', 'max' => 3],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            [
                'name, slug, status, coff',
                'safe',
                'on' => 'search'
            ],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'status' => 'Status',
            'coff' => 'Coefficient',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('coff', $this->coff, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'sort' => ['defaultOrder' => 'id DESC'],
        ]);
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('CurrencyModule.currency', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('CurrencyModule.currency', 'Published'),
        ];
    }

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('CurrencyModule.currency', '*unknown*');
    }

    /**
     * @return array
     */
    public static function getCurrencyAll($all = false)
    {
        $currencies = self::model()->findAllByAttributes(['status' => self::STATUS_PUBLISHED]);
        $currencyArray = [];

        foreach ($currencies as $currency) {
            if(!$all && $currency->slug === Yii::app()->controller->currency) continue;

            $currencyArray[] = [
                'label' => $currency->slug,
                'url' => '#'
            ];
        }

        if($all || Yii::app()->controller->currency !== 'EUR') {
            $currencyArray[] = [
                'label' => 'EUR',
                'url' => '#'
            ];
        }

        return $currencyArray;
    }
}
