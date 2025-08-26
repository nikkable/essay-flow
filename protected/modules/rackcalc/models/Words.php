<?php

/**
 * This is the model class for table "{{rc_words}}".
 *
 * The followings are the available columns in table '{{rc_words}}':
 * @property integer $id
 * @property string $name
 * @property string $cost
 * @property string $lang
 *
 */
class Words extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rc_words}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        return [
            ['name', 'length', 'max' => 6],
            ['name', 'numerical'],
            ['cost', 'length', 'max' => 6],
            ['lang', 'length', 'max' => 2],
            ['lang', 'default', 'value' => Yii::app()->sourceLanguage],
            ['lang', 'in', 'range' => array_keys(Yii::app()->getModule('yupe')->getLanguagesList())],
            ['id, name, cost, lang', 'safe', 'on' => 'search'],
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
			'cost' => 'Cost',
            'lang' => 'Language',
		);
	}

    public function beforeValidate()
    {
        if (!$this->lang) {
            $this->lang = Yii::app()->getLanguage();
        }

        return parent::beforeValidate();
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

		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name,true);
		$criteria->compare('cost', $this->cost,true);
        $criteria->compare('lang', $this->lang, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Periods the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

    public static function getWords()
    {
        return CHtml::listData(self::model()->findAll(), 'id', 'name', 'cost');
    }

    public function language($lang)
    {
        $this->getDbCriteria()->mergeWith(
            [
                'condition' => 'lang = :lang',
                'params' => [':lang' => $lang],
            ]
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getFlag()
    {
        return yupe\helpers\YText::langToflag($this->lang);
    }
}
