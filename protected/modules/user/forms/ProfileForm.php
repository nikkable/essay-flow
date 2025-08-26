<?php
use yupe\widgets\YPurifier;

Yii::import('application.modules.other.OtherModule');

/**
 * Форма профиля
 *
 * @category YupeComponents
 * @package  yupe.modules.user.forms
 * @author   YupeTeam <support@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     https://yupe.ru
 *
 **/
class ProfileForm extends CFormModel
{
    public $nick_name;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $verifyCode;
    public $about;
    public $gender;
    public $birth_date;
    public $use_gravatar;
    public $avatar;
    public $site;
    public $location;
    public $phone;
    public $street;
    public $country;
    public $city;
    public $zipcode;
    public $house;
    public $apartment;

    public $subjects;
    public $languages;
    public $skills;
    public $linked;
    public $file;

    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
            ['nick_name, first_name, last_name, middle_name, about, street, country, city, house, apartment, skills, linked', 'filter', 'filter' => 'trim'],
            [
                'nick_name, first_name, last_name, middle_name, about, street, country, city, house, apartment, skills, linked',
                'filter',
                'filter' => [$obj = new YPurifier(), 'purify']
            ],
            ['nick_name', 'required'],
            ['gender', 'numerical', 'min' => 0, 'max' => 3, 'integerOnly' => true],
            ['gender', 'default', 'value' => 0],
            ['birth_date', 'default', 'value' => null],
            ['birth_date', 'date', 'format' => 'yyyy-mm-dd'],
            ['nick_name, first_name, last_name, middle_name', 'length', 'max' => 50],
            ['about', 'length', 'max' => 300],
            ['location', 'length', 'max' => 150],
            ['zipcode', 'length', 'max' => 30],
            ['house', 'length', 'max' => 50],
            ['country', 'length', 'max' => 150],
            ['apartment', 'length', 'max' => 10],
            ['linked', 'length', 'max' => 1000],
            [
                'nick_name',
                'match',
                'pattern' => '/^[A-Za-z0-9_-]{2,50}$/',
                'message' => Yii::t('OtherModule.other', 'Wrong field format for "{attribute}". You can use only letters and digits from 2 to 20 symbols')
            ],
            ['nick_name', 'checkNickName'],
            ['site', 'url', 'allowEmpty' => true],
            ['site', 'length', 'max' => 100],
            ['use_gravatar', 'in', 'range' => [0, 1]],
            [
                'avatar',
                'file',
                'types' => $module->avatarExtensions,
                'maxSize' => $module->avatarMaxSize,
                'allowEmpty' => true
            ],
            ['phone, subjects, languages, file', 'safe']
//            [
//                'phone',
//                'match',
//                'pattern' => $module->phonePattern,
//                'message' => Yii::t('OtherModule.other', 'Incorrect field format {attribute}')
//            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('OtherModule.other', 'Name'),
            'last_name' => Yii::t('OtherModule.other', 'Last name'),
            'middle_name' => Yii::t('OtherModule.other', 'Family name'),
            'nick_name' => Yii::t('OtherModule.other', 'User name'),
            'gender' => Yii::t('OtherModule.other', 'Sex'),
            'birth_date' => Yii::t('OtherModule.other', 'Birthday date'),
            'about' => Yii::t('OtherModule.other', 'About yourself'),
            'avatar' => Yii::t('OtherModule.other', 'Avatar'),
            'use_gravatar' => Yii::t('OtherModule.other', 'Gravatar'),
            'site' => Yii::t('OtherModule.other', 'Site'),
            'location' => Yii::t('OtherModule.other', 'Address'),
            'phone' => Yii::t('OtherModule.other', 'Phone'),
            'street' => Yii::t('OtherModule.other', 'Street'),
            'country' => Yii::t('OtherModule.other', 'Country'),
            'city' => Yii::t('OtherModule.other', 'City'),
            'zipcode' => Yii::t('OtherModule.other', 'Zipcode'),
            'house' => Yii::t('OtherModule.other', 'State'),
            'subjects' => Yii::t('OtherModule.other', 'Subjects'),
            'languages' => Yii::t('OtherModule.other', 'Languages'),
            'skills' => Yii::t('OtherModule.other', 'Describe your skills and background'),
            'linked' => Yii::t('OtherModule.other', 'LinkedIn'),
            'file' => Yii::t('OtherModule.other', 'CV'),
        ];
    }

    public function checkNickName($attribute, $params)
    {
        // Если ник поменяли
        if (Yii::app()->user->profile->nick_name != $this->$attribute) {
            $model = User::model()->find('nick_name = :nick_name', [':nick_name' => $this->$attribute]);
            if ($model) {
                $this->addError('nick_name', Yii::t('UserModule.user', 'Nick in use'));
            }
        }
    }
}
