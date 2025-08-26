<?php

/**
 * This is the model class for table "{{rc_subjects}}".
 *
 * The followings are the available columns in table '{{rc_subjects}}':
 * @property integer $id
 * @property string $name
 * @property string $cost
 * @property string $lang
 * @property string $code
 *
 */
class Subjects extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rc_subjects}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        return [
            ['name', 'length', 'max' => 255],
            ['cost', 'length', 'max' => 6],
            ['lang', 'length', 'max' => 2],
            ['lang', 'default', 'value' => Yii::app()->sourceLanguage],
            ['lang', 'in', 'range' => array_keys(Yii::app()->getModule('yupe')->getLanguagesList())],
            ['code', 'required', 'except' => 'search'],
            ['code', 'length', 'max' => 100],
            ['code', 'yupe\components\validators\YUniqueSlugValidator'],
            [
                'code',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t(
                    'RackcalcModule.rackcalc',
                    'Unknown field format "{attribute}" only alphas, digits and _, from 2 to 50 characters'
                )
            ],
            ['id, name, cost, lang, code', 'safe', 'on' => 'search'],
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
			'cost' => 'Percent',
            'lang' => 'Language',
            'code' => 'Code',
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
		$criteria->compare('name', $this->name, true);
		$criteria->compare('cost', $this->cost, true);
        $criteria->compare('lang', $this->lang, true);
        $criteria->compare('code', $this->code, true);

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

    public static function getSubjects()
    {
        $lists = self::model()->language(Yii::app()->getLanguage())->findAll();

        if(count($lists) === 0) {
            return self::model()->language(Yii::app()->getModule('yupe')->defaultLanguage)->findAll();
        }

        return $lists;
    }

    public static function getSubjectsDropdown()
    {
        $lists = self::model()->language(Yii::app()->getLanguage())->findAll();


        return CHtml::listData($lists, 'code', 'name');
    }
}
