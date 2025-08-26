<?php
/**
 * @property integer $id
 * @property string $create_time
 * @property string $update_time
 * @property string $date
 * @property string $title
 * @property string $slug
 * @property string $short_text
 * @property string $full_text
 * @property integer $status
 * @property string $image
 * @property string $description
 * @property string $title_seo
 * @property string $badge
 * @property string $badge_color
// * @property string $bg_stock
 * @property string $field
 */

use yupe\components\Event;
use yupe\widgets\YPurifier;

class Faq extends yupe\models\YModel
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
     *  Статус - на модерации
     */
    const STATUS_MODERATION = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{faq}}';
	}

	/**
	 * @return array validation rules for model attributes.
	*/
	public function rules()
	{
		return [
			['title, slug, short_text, full_text, description', 'filter', 'filter' => 'trim'],
            ['date, title, slug, full_text', 'required', 'on' => ['update', 'insert']],
            ['status', 'numerical', 'integerOnly' => true],
            ['title, slug, badge', 'length', 'max' => 150],
            ['lang', 'length', 'max' => 2],
            ['badge, badge_color, field', 'safe'],
            ['lang', 'default', 'value' => Yii::app()->sourceLanguage],
            ['lang', 'in', 'range' => array_keys(Yii::app()->getModule('yupe')->getLanguagesList())],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['slug', 'yupe\components\validators\YUniqueSlugValidator'],
            [
                'slug',
                'yupe\components\validators\YSLugValidator',
                'message' => Yii::t('FaqModule.faq', 'Bad characters in {attribute} field')
            ],
            [
                'id, description, create_time, update_time, date, title, slug, short_text, full_text, status, lang, badge_color',
                'safe',
                'on' => 'search'
            ],
		];
	}

    /**
     * @return array
    */
    public function behaviors()
    {
        $module = Yii::app()->getModule('faq');

        return [
            'imageUpload' => [
                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->uploadPath,
                'deleteFileKey' => 'delete-image',
            ],
//            'imageBgStockUpload' => [
//                'class' => 'yupe\components\behaviors\ImageUploadBehavior',
//                'attributeName' => 'bg_stock',
//                'minSize' => $module->minSize,
//                'maxSize' => $module->maxSize,
//                'types' => $module->allowedExtensions,
//                'uploadPath' => $module->uploadPathBgStock,
//                'deleteFileKey' => 'delete-image-bg-stock',
//            ],
        ];
    }

//    public function getIBgStockUrl($width = 0, $height = 0, $crop = true)
//    {
//        $module = Yii::app()->getModule('faq');
//        $file = Yii::getPathOfAlias('webroot').'/uploads/'.$module->uploadPathBgStock.'/'.$this->bg_stock;
//
//        if ($width || $height) {
//            return $this->thumbnailer->thumbnail(
//                $file,
//                $module->uploadPathBgStock,
//                $width,
//                $height,
//                $crop
//            );
//        }
//
//        return '/uploads/'.$module->uploadPathBgStock.'/'.$this->bg_stock;
//    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return [

        ];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_time' => Yii::t('FaqModule.faq', 'Create time'),
			'update_time' => Yii::t('FaqModule.faq', 'Update time'),
			'date' => Yii::t('FaqModule.faq', 'Date'),
			'title' => Yii::t('FaqModule.faq', 'Title actions'),
			'slug' => Yii::t('FaqModule.faq', 'Slug'),
			'image' => Yii::t('FaqModule.faq', 'Image stocks'),
			'lang' => Yii::t('FaqModule.faq', 'Language'),
			'short_text' => Yii::t('FaqModule.faq', 'Short text'),
			'full_text' => Yii::t('FaqModule.faq', 'Full text'),
			'status' => Yii::t('FaqModule.faq', 'Status'),
			'description' => Yii::t('FaqModule.faq', 'Seo description'),
            'badge' => Yii::t('FaqModule.faq', 'Name badge'),
            'badge_color' => Yii::t('FaqModule.faq', 'Color background badge'),
            'field' => Yii::t('FaqModule.faq', 'CSS - цвет Заголовка и описания'),
		);
	}

	public function beforeValidate()
    {
        if (!$this->slug) {
            $this->slug = yupe\helpers\YText::translit($this->title);
        }

        if (!$this->lang) {
            $this->lang = Yii::app()->getLanguage();
        }

        return parent::beforeValidate();
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->update_time = new CDbExpression('NOW()');
        $this->date = date('Y-m-d', strtotime($this->date));

        if ($this->getIsNewRecord()) {
            $this->create_time = $this->update_time;
        }

        return parent::beforeSave();
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
        $criteria->compare('create_time', $this->create_time, true);
        $criteria->compare('update_time', $this->update_time, true);
        if ($this->date) {
            $criteria->compare('date', date('Y-m-d', strtotime($this->date)));
        }
        $criteria->compare('title', $this->title, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('short_text', $this->short_text, true);
        $criteria->compare('full_text', $this->full_text, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('lang', $this->lang);
        $criteria->compare('badge_color', $this->badge_color);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'sort' => ['defaultOrder' => 'date DESC'],
        ]);
	}

	/**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT => Yii::t('FaqModule.faq', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('FaqModule.faq', 'Published'),
            self::STATUS_MODERATION => Yii::t('FaqModule.faq', 'On moderation'),
        ];
    }

	/**
     * @return mixed|string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('FaqModule.faq', '*unknown*');
    }

    /**
     * @return string
     */
    public function getFlag()
    {
        return yupe\helpers\YText::langToflag($this->lang);
    }

    public function listStocks($lang){
        $criteria = new CDbCriteria();
		$criteria->order = 'title ASC';
		$stocks = self::model()->findAllByAttributes(['lang' => $lang], $criteria);
		
		return CHtml::listData($stocks, 'id', 'title');
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 */
	public static function model($className=__CLASS__)
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
}
