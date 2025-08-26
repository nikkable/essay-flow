<?php
use yupe\widgets\YPurifier;

/**
 * This is the model class for table "{{user_user}}".
 *
 * The followings are the available columns in table '{{user_user}}':
 * @property integer $id
 * @property string  $update_time
 * @property string  $first_name
 * @property string  $middle_name
 * @property string  $last_name
 * @property string  $nick_name
 * @property string  $email
 * @property string  $phone
 * @property integer $gender
 * @property string  $avatar
 * @property string  $hash
 * @property integer $status
 * @property integer $access_level
 * @property string  $visit_time
 * @property boolean $email_confirm
 * @property string  $create_time
 * @property string $street
 * @property string $country
 * @property string $zipcode
 * @property string $city
 * @property string $house
 * @property string $apartment
 * @property string $subjects
 * @property string $skills
 * @property string $linked
 * @property string $file
 * @property int $author_verification_status
 * @property string $languages
 *
 */
class User extends yupe\models\YModel
{
    /**
     *
     */
    const GENDER_THING = 0;
    /**
     *
     */
    const GENDER_MALE = 1;
    /**
     *
     */
    const GENDER_FEMALE = 2;

    /**
     *
     */
    const STATUS_BLOCK = 0;
    /**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_NOT_ACTIVE = 2;

    /**
     *
     */
    const EMAIL_CONFIRM_NO = 0;
    /**
     *
     */
    const EMAIL_CONFIRM_YES = 1;

    /**
     *
     */
    const ACCESS_LEVEL_USER = 0;
    /**
     *
     */
    const ACCESS_LEVEL_ADMIN = 1;

    const AUTHOR_VERIFICATION_PENDING = 0;
    const AUTHOR_VERIFICATION_VERIFIED = 1;
    const AUTHOR_VERIFICATION_REJECTED = 2;

    /**
     * @var
     */
    private $_oldAccess_level;
    /**
     * @var
     */
    private $_oldStatus;
    /**
     * @var bool
     */
    public $use_gravatar = false;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_user}}';
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @return User the static model class
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
        $module = Yii::app()->getModule('user');

        return [
            [
                'birth_date, site, about, location, nick_name, first_name, last_name, middle_name, email, street, country, city, house, apartment, skills, linked',
                'filter',
                'filter' => 'trim'
            ],
            [
                'birth_date, site, about, location, nick_name, first_name, last_name, middle_name, email, street, country, city, house, apartment, skills, linked',
                'filter',
                'filter' => [$obj = new YPurifier(), 'purify']
            ],
            ['nick_name, email, hash', 'required'],
            ['first_name, last_name, middle_name, nick_name, email', 'length', 'max' => 50],
            ['hash', 'length', 'max' => 256],
            ['city, street', 'length', 'max' => 255],
            ['site', 'length', 'max' => 100],
            ['about', 'length', 'max' => 300],
            ['location', 'length', 'max' => 150],
            ['zipcode', 'length', 'max' => 30],
            ['house', 'length', 'max' => 50],
            ['country', 'length', 'max' => 150],
            ['apartment', 'length', 'max' => 10],
            ['linked', 'length', 'max' => 1000],
            ['gender, status, access_level', 'numerical', 'integerOnly' => true],
            ['gender', 'default', 'value' => self::GENDER_THING, 'setOnEmpty' => true],
            [
                'nick_name',
                'match',
                'pattern' => '/^[A-Za-z0-9_-]{2,50}$/',
                'message' => Yii::t('OtherModule.other', 'Wrong field format for "{attribute}". You can use only letters and digits from 2 to 20 symbols')
            ],
            ['site', 'url', 'allowEmpty' => true],
            ['email', 'email'],
            ['email', 'unique', 'message' => Yii::t('OtherModule.other', 'This email already use by another user')],
            [
                'nick_name',
                'unique',
                'message' => Yii::t('OtherModule.other', 'This email already use by another user')
            ],
            [
                'avatar',
                'file',
                'types' => $module->avatarExtensions,
                'maxSize' => $module->avatarMaxSize,
                'allowEmpty' => true,
                'safe' => false
            ],
            ['email_confirm', 'in', 'range' => array_keys($this->getEmailConfirmStatusList())],
            ['author_verification_status', 'in', 'range' => array_keys($this->getAuthorVerificationStatusList())],
            ['author_verification_status', 'numerical', 'integerOnly' => true],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['create_time', 'length', 'max' => 50],
            [
                'id, update_time, create_time, middle_name, first_name, last_name, nick_name, email, gender, avatar, status, access_level, visit_time, phone, author_verification_status',
                'safe',
                'on' => 'search'
            ],
            ['birth_date', 'default', 'setOnEmpty' => true, 'value' => null],
            ['phone, subjects, languages, file', 'safe']
//            [
//                'phone',
//                'match',
//                'pattern' => $module->phonePattern,
//                'message' => 'Incorrect field format {attribute}'
//            ],



    // ... добавьте в safe для поиска
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $module = Yii::app()->getModule('user');

        return [
            'CTimestampBehavior' => [
                'class' => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => true,
            ],
            'file-upload' => [
                'class'         => 'yupe\components\behaviors\FileUploadBehavior',
                'attributeName' => 'file',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
                'fileInstanceName' => 'ProfileForm[file]',
            ],
        ];
    }

    /**
     * Массив связей:
     *
     * @return array
     */
    public function relations()
    {
        return [
            'tokens' => [
                self::HAS_MANY,
                'UserToken',
                'user_id'
            ]
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserModule.user', 'Id'),
            'creation_date' => Yii::t('UserModule.user', 'Activated at'),
            'update_time' => Yii::t('UserModule.user', 'Updated at'),
            'first_name' => Yii::t('UserModule.user', 'Name'),
            'last_name' => Yii::t('UserModule.user', 'Last name'),
            'middle_name' => Yii::t('UserModule.user', 'Family name'),
            'full_name' => Yii::t('UserModule.user', 'Full name'),
            'nick_name' => Yii::t('UserModule.user', 'Nick'),
            'email' => Yii::t('UserModule.user', 'Email'),
            'gender' => Yii::t('UserModule.user', 'Sex'),
            'status' => Yii::t('UserModule.user', 'Status'),
            'access_level' => Yii::t('UserModule.user', 'Access'),
            'visit_time' => Yii::t('UserModule.user', 'Last visit'),
            'create_time' => Yii::t('UserModule.user', 'Register date'),
            'avatar' => Yii::t('UserModule.user', 'Avatar'),
            'use_gravatar' => Yii::t('UserModule.user', 'Gravatar'),
            'email_confirm' => Yii::t('UserModule.user', 'Email was confirmed'),
            'birth_date' => Yii::t('UserModule.user', 'Birthday'),
            'site' => Yii::t('UserModule.user', 'Site/blog'),
            'location' => Yii::t('UserModule.user', 'Location'),
            'about' => Yii::t('UserModule.user', 'About yourself'),
            'phone' => Yii::t('UserModule.user', 'Phone'),
            'street' => Yii::t('UserModule.user', 'Street'),
            'country' => Yii::t('UserModule.user', 'Country'),
            'city' => Yii::t('UserModule.user', 'City'),
            'zipcode' => Yii::t('UserModule.user', 'Zipcode'),
            'house' => Yii::t('UserModule.user', 'State'),
            'apartment' => Yii::t('UserModule.user', 'Apartment'),
            'subjects' => Yii::t('UserModule.user', 'Subjects to assign'),
            'skills' => Yii::t('UserModule.user', 'Describe your skills and background'),
            'linked' => Yii::t('UserModule.user', 'LinkedIn'),
            'file' => Yii::t('UserModule.user', 'CV'),
            'author_verification_status' => Yii::t('UserModule.user', 'Author verification status'),
            'languages' => Yii::t('UserModule.user', 'Languages'),
        ];
    }

    /**
     * Проверка верификации почты:
     *
     * @return boolean
     */
    public function getIsVerifyEmail()
    {
        return $this->email_confirm;
    }

    /**
     * Строковое значение верификации почты пользователя:
     *
     * @return string
     */
    public function getIsVerifyEmailStatus()
    {
        return $this->getIsVerifyEmail()
            ? Yii::t('UserModule.user', 'Yes')
            : Yii::t('UserModule.user', 'No');
    }

    /**
     * Поиск пользователей по заданным параметрам:
     *
     * @return CActiveDataProvider
     */
    public function search($pageSize = 10)
    {
        $criteria = new CDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.update_time', $this->update_time, true);
        if ($this->create_time) {
            $criteria->compare('t.create_time', date('Y-m-d', strtotime($this->create_time)), true);
        }
        $criteria->compare('t.first_name', $this->first_name, true);
        $criteria->compare('t.middle_name', $this->middle_name, true);
        $criteria->compare('t.last_name', $this->last_name, true);
        $criteria->compare('t.nick_name', $this->nick_name, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.phone', $this->phone, true);
        $criteria->compare('t.gender', $this->gender);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.access_level', $this->access_level);
        if ($this->visit_time) {
            $criteria->compare('t.visit_time', date('Y-m-d', strtotime($this->visit_time)), true);
        }
        $criteria->compare('t.email_confirm', $this->email_confirm);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => 'visit_time DESC',
            ]
        ]);
    }

    /**
     * Метод после поиска:
     *
     * @return void
     */
    public function afterFind()
    {
        $this->_oldAccess_level = $this->access_level;
        $this->_oldStatus = $this->status;
        // Если пустое поле аватар - автоматически
        // включаем граватар:
        $this->use_gravatar = empty($this->avatar);

        if (!empty($this->subjects)) {
            $this->subjects = explode(',', $this->subjects);
        } else {
            $this->subjects = [];
        }

        if (!empty($this->languages)) {
            $this->languages = explode(',', $this->languages);
        } else {
            $this->languages = [];
        }

        parent::afterFind();
    }

    /**
     * Метод выполняемый перед сохранением:
     *
     * @return bool
     */
    public function beforeSave()
    {
        if (is_array($this->subjects)) {
            $this->subjects = implode(',', $this->subjects);
        }

        if (is_array($this->languages)) {
            $this->languages = implode(',', $this->languages);
        }

        if (!$this->getIsNewRecord() && $this->_oldAccess_level === self::ACCESS_LEVEL_ADMIN) {
            // Запрещаем действия, при которых администратор
            // может быть заблокирован или сайт останется без
            // администратора:
            if (
                $this->admin()->count() == 1
                && ((int)$this->access_level === self::ACCESS_LEVEL_USER || (int)$this->status !== self::STATUS_ACTIVE)
            ) {
                $this->addError(
                    'access_level',
                    Yii::t('UserModule.user', 'You can\'t make this changes!')
                );

                return false;
            }
        }

        return parent::beforeSave();
    }


    /**
     * Метод перед удалением:
     *
     * @return bool
     */
    public function beforeDelete()
    {
        if ($this->_oldAccess_level == self::ACCESS_LEVEL_ADMIN && $this->admin()->count() == 1) {
            $this->addError(
                'access_level',
                Yii::t('UserModule.user', 'You can\'t make this changes!')
            );

            return false;
        }

        return parent::beforeDelete();
    }

    /**
     * Именнованные условия:
     *
     * @return array
     */
    public function scopes()
    {
        return [
            'active' => [
                'condition' => 't.status = :user_status',
                'params' => [
                    ':user_status' => self::STATUS_ACTIVE
                ],
            ],
            'registered' => [
                'condition' => 't.status = :user_status',
                'params' => [
                    ':user_status' => self::STATUS_NOT_ACTIVE
                ],
            ],
            'blocked' => [
                'condition' => 'status = :blocked_status',
                'params' => [':blocked_status' => self::STATUS_BLOCK],
            ],
            'admin' => [
                'condition' => 'access_level = :access_level',
                'params' => [':access_level' => self::ACCESS_LEVEL_ADMIN],
            ],
            'user' => [
                'condition' => 'access_level = :access_level',
                'params' => [':access_level' => self::ACCESS_LEVEL_USER],
            ],
        ];
    }

    /**
     * Список текстовых значений ролей:
     *
     * @return array
     */
    public function getAccessLevelsList()
    {
        return [
            self::ACCESS_LEVEL_ADMIN => Yii::t('UserModule.user', 'Administrator'),
            self::ACCESS_LEVEL_USER => Yii::t('UserModule.user', 'User'),
        ];
    }

    /**
     * Получаем строковое значение роли
     * пользователя:
     *
     * @return string
     */
    public function getAccessLevel()
    {
        $data = $this->getAccessLevelsList();

        return isset($data[$this->access_level]) ? $data[$this->access_level] : Yii::t('UserModule.user', '*no*');
    }

    /**
     * Список возможных статусов пользователя:
     *
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('UserModule.user', 'Active'),
            self::STATUS_BLOCK => Yii::t('UserModule.user', 'Blocked'),
            self::STATUS_NOT_ACTIVE => Yii::t('UserModule.user', 'Not activated'),
        ];
    }

    /**
     * Получение строкового значения
     * статуса пользователя:
     *
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status])
            ? $data[$this->status]
            : Yii::t('UserModule.user', 'status is not set');
    }

    /**
     * @return array
     */
    public function getEmailConfirmStatusList()
    {
        return [
            self::EMAIL_CONFIRM_YES => Yii::t('UserModule.user', 'Yes'),
            self::EMAIL_CONFIRM_NO => Yii::t('UserModule.user', 'No'),
        ];
    }

    /**
     * @return string
     */
    public function getEmailConfirmStatus()
    {
        $data = $this->getEmailConfirmStatusList();

        return isset($data[$this->email_confirm]) ? $data[$this->email_confirm] : Yii::t(
            'UserModule.user',
            '*unknown*'
        );
    }

    /**
     * Список статусов половой принадлежности:
     *
     * @return array
     */
    public function getGendersList()
    {
        return [
            self::GENDER_FEMALE => Yii::t('UserModule.user', 'female'),
            self::GENDER_MALE => Yii::t('UserModule.user', 'male'),
            self::GENDER_THING => Yii::t('UserModule.user', 'not set'),
        ];
    }

    /**
     * Получаем строковое значение половой
     * принадлежности пользователя:
     *
     * @return string
     */
    public function getGender()
    {
        $data = $this->getGendersList();

        return isset($data[$this->gender])
            ? $data[$this->gender]
            : $data[self::GENDER_THING];
    }

    /**
     * Получить url аватарки пользователя:
     * -----------------------------------
     * Возвращаем именно url, так как на
     * фронте может быть любая вариация
     * использования, незачем ограничивать
     * разработчиков.
     *
     * @param int $size - требуемый размер аватарки в пикселях
     *
     * @return string - url аватарки
     */
    public function getAvatar($size = 64)
    {
        $size = (int)$size;

        $userModule = Yii::app()->getModule('user');

        // если это граватар
        if ($this->use_gravatar && $this->email) {
            return 'https://gravatar.com/avatar/' . md5(trim($this->email)) . "?s=" . $size . "&d=" . urlencode(
                    Yii::app()->createAbsoluteUrl('/') . $userModule->getDefaultAvatar()
                );
        }

        $avatar = $this->avatar;
        $path = $userModule->getUploadPath();

        if (!file_exists($path)) {
            $avatar = $userModule->defaultAvatar;
        }

        return Yii::app()->thumbnailer->thumbnail(
            $path . $avatar,
            $userModule->avatarsDir,
            $size,
            $size
        );
    }

    /**
     * Получаем список пользователей с полным имем:
     *
     * @param string $separator - разделитель
     *
     * @return string
     */
    public static function getFullNameList($separator = ' ')
    {
        $list = [];

        foreach (User::model()->cache(Yii::app()->getModule('yupe')->coreCacheTime)->findAll() as $user) {
            $list[$user->id] = $user->getFullName($separator);
        }

        return $list;
    }

    /**
     * Получаем полное имя пользователя:
     *
     * @param string $separator - разделитель
     *
     * @return string
     */
    public function getFullName($separator = ' ')
    {
        return ($this->first_name || $this->last_name)
            ? $this->last_name . $separator . $this->first_name . ($this->middle_name ? ($separator . $this->middle_name) : "")
            : $this->nick_name;
    }

    /**
     * Удаление старого аватара:
     *
     * @return boolean
     */
    public function removeOldAvatar()
    {
        if (!$this->avatar) {
            return true;
        }

        $basePath = Yii::app()->getModule('user')->getUploadPath();

        if (file_exists($basePath . $this->avatar)) {
            @unlink($basePath . $this->avatar);
        }

        //remove old resized avatars
        foreach (glob($basePath . '/thumbs/' . '*' . $this->avatar) as $thumb) {
            @unlink($thumb);
        }

        $this->avatar = null;

        return true;
    }

    /**
     * Устанавливает новый аватар
     *
     * @param CUploadedFile $uploadedFile
     *
     * @throws CException
     *
     * @return boolean
     */
    public function changeAvatar(CUploadedFile $uploadedFile)
    {
        $basePath = Yii::app()->getModule('user')->getUploadPath();

        //создаем каталог для аватарок, если не существует
        if (!is_dir($basePath) && !@mkdir($basePath, 0755, true)) {
            throw new CException(Yii::t('UserModule.user', 'It is not possible to create directory for avatars!'));
        }

        $filename = $this->id . '_' . time() . '.' . $uploadedFile->extensionName;

        $this->removeOldAvatar();

        if (!$uploadedFile->saveAs($basePath . $filename)) {
            throw new CException(Yii::t('UserModule.user', 'It is not possible to save avatar!'));
        }

        $this->use_gravatar = false;

        $this->avatar = $filename;

        return true;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (int)$this->status === self::STATUS_ACTIVE;
    }

    /**
     * @return $this
     */
    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm = self::EMAIL_CONFIRM_YES;
        return $this;
    }

    public static function getCountryList()
    {
        return [
            "AF" => Yii::t('OtherModule.other', "Afghanistan"),
            "AL" => Yii::t('OtherModule.other', "Albania"),
            "DZ" => Yii::t('OtherModule.other', "Algeria"),
            "AS" => Yii::t('OtherModule.other', "American Samoa"),
            "AD" => Yii::t('OtherModule.other', "Andorra"),
            "AO" => Yii::t('OtherModule.other', "Angola"),
            "AI" => Yii::t('OtherModule.other', "Anguilla"),
            "AQ" => Yii::t('OtherModule.other', "Antarctica"),
            "AG" => Yii::t('OtherModule.other', "Antigua and Barbuda"),
            "AR" => Yii::t('OtherModule.other', "Argentina"),
            "AM" => Yii::t('OtherModule.other', "Armenia"),
            "AW" => Yii::t('OtherModule.other', "Aruba"),
            "AU" => Yii::t('OtherModule.other', "Australia"),
            "AT" => Yii::t('OtherModule.other', "Austria"),
            "AZ" => Yii::t('OtherModule.other', "Azerbaijan"),
            "BS" => Yii::t('OtherModule.other', "Bahamas (the)"),
            "BH" => Yii::t('OtherModule.other', "Bahrain"),
            "BD" => Yii::t('OtherModule.other', "Bangladesh"),
            "BB" => Yii::t('OtherModule.other', "Barbados"),
            "BY" => Yii::t('OtherModule.other', "Belarus"),
            "BE" => Yii::t('OtherModule.other', "Belgium"),
            "BZ" => Yii::t('OtherModule.other', "Belize"),
            "BJ" => Yii::t('OtherModule.other', "Benin"),
            "BM" => Yii::t('OtherModule.other', "Bermuda"),
            "BT" => Yii::t('OtherModule.other', "Bhutan"),
            "BO" => Yii::t('OtherModule.other', "Bolivia (Plurinational State of)"),
            "BQ" => Yii::t('OtherModule.other', "Bonaire, Sint Eustatius and Saba"),
            "BA" => Yii::t('OtherModule.other', "Bosnia and Herzegovina"),
            "BW" => Yii::t('OtherModule.other', "Botswana"),
            "BV" => Yii::t('OtherModule.other', "Bouvet Island"),
            "BR" => Yii::t('OtherModule.other', "Brazil"),
            "IO" => Yii::t('OtherModule.other', "British Indian Ocean Territory (the)"),
            "BN" => Yii::t('OtherModule.other', "Brunei Darussalam"),
            "BG" => Yii::t('OtherModule.other', "Bulgaria"),
            "BF" => Yii::t('OtherModule.other', "Burkina Faso"),
            "BI" => Yii::t('OtherModule.other', "Burundi"),
            "CV" => Yii::t('OtherModule.other', "Cabo Verde"),
            "KH" => Yii::t('OtherModule.other', "Cambodia"),
            "CM" => Yii::t('OtherModule.other', "Cameroon"),
            "CA" => Yii::t('OtherModule.other', "Canada"),
            "KY" => Yii::t('OtherModule.other', "Cayman Islands (the)"),
            "CF" => Yii::t('OtherModule.other', "Central African Republic (the)"),
            "TD" => Yii::t('OtherModule.other', "Chad"),
            "CL" => Yii::t('OtherModule.other', "Chile"),
            "CN" => Yii::t('OtherModule.other', "China"),
            "CX" => Yii::t('OtherModule.other', "Christmas Island"),
            "CC" => Yii::t('OtherModule.other', "Cocos (Keeling) Islands (the)"),
            "CO" => Yii::t('OtherModule.other', "Colombia"),
            "KM" => Yii::t('OtherModule.other', "Comoros (the)"),
            "CD" => Yii::t('OtherModule.other', "Congo (the Democratic Republic of the)"),
            "CG" => Yii::t('OtherModule.other', "Congo (the)"),
            "CK" => Yii::t('OtherModule.other', "Cook Islands (the)"),
            "CR" => Yii::t('OtherModule.other', "Costa Rica"),
            "HR" => Yii::t('OtherModule.other', "Croatia"),
            "CU" => Yii::t('OtherModule.other', "Cuba"),
            "CW" => Yii::t('OtherModule.other', "Curaçao"),
            "CY" => Yii::t('OtherModule.other', "Cyprus"),
            "CZ" => Yii::t('OtherModule.other', "Czechia"),
            "CI" => Yii::t('OtherModule.other', "Côte d'Ivoire"),
            "DK" => Yii::t('OtherModule.other', "Denmark"),
            "DJ" => Yii::t('OtherModule.other', "Djibouti"),
            "DM" => Yii::t('OtherModule.other', "Dominica"),
            "DO" => Yii::t('OtherModule.other', "Dominican Republic (the)"),
            "EC" => Yii::t('OtherModule.other', "Ecuador"),
            "EG" => Yii::t('OtherModule.other', "Egypt"),
            "SV" => Yii::t('OtherModule.other', "El Salvador"),
            "GQ" => Yii::t('OtherModule.other', "Equatorial Guinea"),
            "ER" => Yii::t('OtherModule.other', "Eritrea"),
            "EE" => Yii::t('OtherModule.other', "Estonia"),
            "SZ" => Yii::t('OtherModule.other', "Eswatini"),
            "ET" => Yii::t('OtherModule.other', "Ethiopia"),
            "FK" => Yii::t('OtherModule.other', "Falkland Islands (the) [Malvinas]"),
            "FO" => Yii::t('OtherModule.other', "Faroe Islands (the)"),
            "FJ" => Yii::t('OtherModule.other', "Fiji"),
            "FI" => Yii::t('OtherModule.other', "Finland"),
            "FR" => Yii::t('OtherModule.other', "France"),
            "GF" => Yii::t('OtherModule.other', "French Guiana"),
            "PF" => Yii::t('OtherModule.other', "French Polynesia"),
            "TF" => Yii::t('OtherModule.other', "French Southern Territories (the)"),
            "GA" => Yii::t('OtherModule.other', "Gabon"),
            "GM" => Yii::t('OtherModule.other', "Gambia (the)"),
            "GE" => Yii::t('OtherModule.other', "Georgia"),
            "DE" => Yii::t('OtherModule.other', "Germany"),
            "GH" => Yii::t('OtherModule.other', "Ghana"),
            "GI" => Yii::t('OtherModule.other', "Gibraltar"),
            "GR" => Yii::t('OtherModule.other', "Greece"),
            "GL" => Yii::t('OtherModule.other', "Greenland"),
            "GD" => Yii::t('OtherModule.other', "Grenada"),
            "GP" => Yii::t('OtherModule.other', "Guadeloupe"),
            "GU" => Yii::t('OtherModule.other', "Guam"),
            "GT" => Yii::t('OtherModule.other', "Guatemala"),
            "GG" => Yii::t('OtherModule.other', "Guernsey"),
            "GN" => Yii::t('OtherModule.other', "Guinea"),
            "GW" => Yii::t('OtherModule.other', "Guinea-Bissau"),
            "GY" => Yii::t('OtherModule.other', "Guyana"),
            "HT" => Yii::t('OtherModule.other', "Haiti"),
            "HM" => Yii::t('OtherModule.other', "Heard Island and McDonald Islands"),
            "VA" => Yii::t('OtherModule.other', "Holy See (the)"),
            "HN" => Yii::t('OtherModule.other', "Honduras"),
            "HK" => Yii::t('OtherModule.other', "Hong Kong"),
            "HU" => Yii::t('OtherModule.other', "Hungary"),
            "IS" => Yii::t('OtherModule.other', "Iceland"),
            "IN" => Yii::t('OtherModule.other', "India"),
            "ID" => Yii::t('OtherModule.other', "Indonesia"),
            "IR" => Yii::t('OtherModule.other', "Iran (Islamic Republic of)"),
            "IQ" => Yii::t('OtherModule.other', "Iraq"),
            "IE" => Yii::t('OtherModule.other', "Ireland"),
            "IM" => Yii::t('OtherModule.other', "Isle of Man"),
            "IL" => Yii::t('OtherModule.other', "Israel"),
            "IT" => Yii::t('OtherModule.other', "Italy"),
            "JM" => Yii::t('OtherModule.other', "Jamaica"),
            "JP" => Yii::t('OtherModule.other', "Japan"),
            "JE" => Yii::t('OtherModule.other', "Jersey"),
            "JO" => Yii::t('OtherModule.other', "Jordan"),
            "KZ" => Yii::t('OtherModule.other', "Kazakhstan"),
            "KE" => Yii::t('OtherModule.other', "Kenya"),
            "KI" => Yii::t('OtherModule.other', "Kiribati"),
            "KP" => Yii::t('OtherModule.other', "Korea (the Democratic People's Republic of)"),
            "KR" => Yii::t('OtherModule.other', "Korea (the Republic of)"),
            "KW" => Yii::t('OtherModule.other', "Kuwait"),
            "KG" => Yii::t('OtherModule.other', "Kyrgyzstan"),
            "LA" => Yii::t('OtherModule.other', "Lao People's Democratic Republic (the)"),
            "LV" => Yii::t('OtherModule.other', "Latvia"),
            "LB" => Yii::t('OtherModule.other', "Lebanon"),
            "LS" => Yii::t('OtherModule.other', "Lesotho"),
            "LR" => Yii::t('OtherModule.other', "Liberia"),
            "LY" => Yii::t('OtherModule.other', "Libya"),
            "LI" => Yii::t('OtherModule.other', "Liechtenstein"),
            "LT" => Yii::t('OtherModule.other', "Lithuania"),
            "LU" => Yii::t('OtherModule.other', "Luxembourg"),
            "MO" => Yii::t('OtherModule.other', "Macao"),
            "MG" => Yii::t('OtherModule.other', "Madagascar"),
            "MW" => Yii::t('OtherModule.other', "Malawi"),
            "MY" => Yii::t('OtherModule.other', "Malaysia"),
            "MV" => Yii::t('OtherModule.other', "Maldives"),
            "ML" => Yii::t('OtherModule.other', "Mali"),
            "MT" => Yii::t('OtherModule.other', "Malta"),
            "MH" => Yii::t('OtherModule.other', "Marshall Islands (the)"),
            "MQ" => Yii::t('OtherModule.other', "Martinique"),
            "MR" => Yii::t('OtherModule.other', "Mauritania"),
            "MU" => Yii::t('OtherModule.other', "Mauritius"),
            "YT" => Yii::t('OtherModule.other', "Mayotte"),
            "MX" => Yii::t('OtherModule.other', "Mexico"),
            "FM" => Yii::t('OtherModule.other', "Micronesia (Federated States of)"),
            "MD" => Yii::t('OtherModule.other', "Moldova (the Republic of)"),
            "MC" => Yii::t('OtherModule.other', "Monaco"),
            "MN" => Yii::t('OtherModule.other', "Mongolia"),
            "ME" => Yii::t('OtherModule.other', "Montenegro"),
            "MS" => Yii::t('OtherModule.other', "Montserrat"),
            "MA" => Yii::t('OtherModule.other', "Morocco"),
            "MZ" => Yii::t('OtherModule.other', "Mozambique"),
            "MM" => Yii::t('OtherModule.other', "Myanmar"),
            "NA" => Yii::t('OtherModule.other', "Namibia"),
            "NR" => Yii::t('OtherModule.other', "Nauru"),
            "NP" => Yii::t('OtherModule.other', "Nepal"),
            "NL" => Yii::t('OtherModule.other', "Netherlands (the)"),
            "NC" => Yii::t('OtherModule.other', "New Caledonia"),
            "NZ" => Yii::t('OtherModule.other', "New Zealand"),
            "NI" => Yii::t('OtherModule.other', "Nicaragua"),
            "NE" => Yii::t('OtherModule.other', "Niger (the)"),
            "NG" => Yii::t('OtherModule.other', "Nigeria"),
            "NU" => Yii::t('OtherModule.other', "Niue"),
            "NF" => Yii::t('OtherModule.other', "Norfolk Island"),
            "MP" => Yii::t('OtherModule.other', "Northern Mariana Islands (the)"),
            "NO" => Yii::t('OtherModule.other', "Norway"),
            "OM" => Yii::t('OtherModule.other', "Oman"),
            "PK" => Yii::t('OtherModule.other', "Pakistan"),
            "PW" => Yii::t('OtherModule.other', "Palau"),
            "PS" => Yii::t('OtherModule.other', "Palestine, State of"),
            "PA" => Yii::t('OtherModule.other', "Panama"),
            "PG" => Yii::t('OtherModule.other', "Papua New Guinea"),
            "PY" => Yii::t('OtherModule.other', "Paraguay"),
            "PE" => Yii::t('OtherModule.other', "Peru"),
            "PH" => Yii::t('OtherModule.other', "Philippines (the)"),
            "PN" => Yii::t('OtherModule.other', "Pitcairn"),
            "PL" => Yii::t('OtherModule.other', "Poland"),
            "PT" => Yii::t('OtherModule.other', "Portugal"),
            "PR" => Yii::t('OtherModule.other', "Puerto Rico"),
            "QA" => Yii::t('OtherModule.other', "Qatar"),
            "MK" => Yii::t('OtherModule.other', "Republic of North Macedonia"),
            "RO" => Yii::t('OtherModule.other', "Romania"),
            "RU" => Yii::t('OtherModule.other', "Russian Federation (the)"),
            "RW" => Yii::t('OtherModule.other', "Rwanda"),
            "RE" => Yii::t('OtherModule.other', "Réunion"),
            "BL" => Yii::t('OtherModule.other', "Saint Barthélemy"),
            "SH" => Yii::t('OtherModule.other', "Saint Helena, Ascension and Tristan da Cunha"),
            "KN" => Yii::t('OtherModule.other', "Saint Kitts and Nevis"),
            "LC" => Yii::t('OtherModule.other', "Saint Lucia"),
            "MF" => Yii::t('OtherModule.other', "Saint Martin (French part)"),
            "PM" => Yii::t('OtherModule.other', "Saint Pierre and Miquelon"),
            "VC" => Yii::t('OtherModule.other', "Saint Vincent and the Grenadines"),
            "WS" => Yii::t('OtherModule.other', "Samoa"),
            "SM" => Yii::t('OtherModule.other', "San Marino"),
            "ST" => Yii::t('OtherModule.other', "Sao Tome and Principe"),
            "SA" => Yii::t('OtherModule.other', "Saudi Arabia"),
            "SN" => Yii::t('OtherModule.other', "Senegal"),
            "RS" => Yii::t('OtherModule.other', "Serbia"),
            "SC" => Yii::t('OtherModule.other', "Seychelles"),
            "SL" => Yii::t('OtherModule.other', "Sierra Leone"),
            "SG" => Yii::t('OtherModule.other', "Singapore"),
            "SX" => Yii::t('OtherModule.other', "Sint Maarten (Dutch part)"),
            "SK" => Yii::t('OtherModule.other', "Slovakia"),
            "SI" => Yii::t('OtherModule.other', "Slovenia"),
            "SB" => Yii::t('OtherModule.other', "Solomon Islands"),
            "SO" => Yii::t('OtherModule.other', "Somalia"),
            "ZA" => Yii::t('OtherModule.other', "South Africa"),
            "GS" => Yii::t('OtherModule.other', "South Georgia and the South Sandwich Islands"),
            "SS" => Yii::t('OtherModule.other', "South Sudan"),
            "ES" => Yii::t('OtherModule.other', "Spain"),
            "LK" => Yii::t('OtherModule.other', "Sri Lanka"),
            "SD" => Yii::t('OtherModule.other', "Sudan (the)"),
            "SR" => Yii::t('OtherModule.other', "Suriname"),
            "SJ" => Yii::t('OtherModule.other', "Svalbard and Jan Mayen"),
            "SE" => Yii::t('OtherModule.other', "Sweden"),
            "CH" => Yii::t('OtherModule.other', "Switzerland"),
            "SY" => Yii::t('OtherModule.other', "Syrian Arab Republic"),
            "TW" => Yii::t('OtherModule.other', "Taiwan (Province of China)"),
            "TJ" => Yii::t('OtherModule.other', "Tajikistan"),
            "TZ" => Yii::t('OtherModule.other', "Tanzania, United Republic of"),
            "TH" => Yii::t('OtherModule.other', "Thailand"),
            "TL" => Yii::t('OtherModule.other', "Timor-Leste"),
            "TG" => Yii::t('OtherModule.other', "Togo"),
            "TK" => Yii::t('OtherModule.other', "Tokelau"),
            "TO" => Yii::t('OtherModule.other', "Tonga"),
            "TT" => Yii::t('OtherModule.other', "Trinidad and Tobago"),
            "TN" => Yii::t('OtherModule.other', "Tunisia"),
            "TR" => Yii::t('OtherModule.other', "Turkey"),
            "TM" => Yii::t('OtherModule.other', "Turkmenistan"),
            "TC" => Yii::t('OtherModule.other', "Turks and Caicos Islands (the)"),
            "TV" => Yii::t('OtherModule.other', "Tuvalu"),
            "UG" => Yii::t('OtherModule.other', "Uganda"),
            "UA" => Yii::t('OtherModule.other', "Ukraine"),
            "AE" => Yii::t('OtherModule.other', "United Arab Emirates (the)"),
            "GB" => Yii::t('OtherModule.other', "United Kingdom of Great Britain and Northern Ireland (the)"),
            "UM" => Yii::t('OtherModule.other', "United States Minor Outlying Islands (the)"),
            "US" => Yii::t('OtherModule.other', "United States of America (the)"),
            "UY" => Yii::t('OtherModule.other', "Uruguay"),
            "UZ" => Yii::t('OtherModule.other', "Uzbekistan"),
            "VU" => Yii::t('OtherModule.other', "Vanuatu"),
            "VE" => Yii::t('OtherModule.other', "Venezuela (Bolivarian Republic of)"),
            "VN" => Yii::t('OtherModule.other', "Viet Nam"),
            "VG" => Yii::t('OtherModule.other', "Virgin Islands (British)"),
            "VI" => Yii::t('OtherModule.other', "Virgin Islands (U.S.)"),
            "WF" => Yii::t('OtherModule.other', "Wallis and Futuna"),
            "EH" => Yii::t('OtherModule.other', "Western Sahara"),
            "YE" => Yii::t('OtherModule.other', "Yemen"),
            "ZM" => Yii::t('OtherModule.other', "Zambia"),
            "ZW" => Yii::t('OtherModule.other', "Zimbabwe"),
            "AX" => Yii::t('OtherModule.other', "Åland Islands"),
        ];
    }

    /**
     * Возвращает название(я) роли(ей) пользователя.
     * Если пользователь имеет несколько ролей, они будут объединены через запятую.
     * @return string
     */
    public function getAssignedRolesNames()
    {
        $authAssignments = Yii::app()->authManager->getAuthAssignments($this->id);

        $roleNames = [];
        if (!empty($authAssignments)) {
            foreach ($authAssignments as $itemName => $assignment) {
                $authItem = Yii::app()->authManager->getAuthItem($itemName);

                if ($authItem !== null && $authItem->type == CAuthItem::TYPE_ROLE) {
                    $roleNames[] = $authItem->description ?: $authItem->name;
                }
            }
        }

        return empty($roleNames) ? Yii::t('UserModule.user', 'No role (User)') : implode(', ', $roleNames);
    }

    /**
     * Список возможных статусов верификации автора:
     * @return array
     */
    public function getAuthorVerificationStatusList()
    {
        return [
            self::AUTHOR_VERIFICATION_PENDING  => Yii::t('UserModule.user', 'Pending verification'),
            self::AUTHOR_VERIFICATION_VERIFIED => Yii::t('UserModule.user', 'Verified'),
            self::AUTHOR_VERIFICATION_REJECTED => Yii::t('UserModule.user', 'Rejected'),
        ];
    }

    /**
     * Получение строкового значения статуса верификации автора:
     * @return string
     */
    public function getAuthorVerificationStatus()
    {
        $data = $this->getAuthorVerificationStatusList();
        return isset($data[$this->author_verification_status])
            ? $data[$this->author_verification_status]
            : Yii::t('UserModule.user', 'Unknown');
    }

    public function isVerifyAuthorEnabled()
    {
        return $this->nick_name && $this->phone && $this->street && $this->country && $this->city && $this->zipcode && $this->house && $this->subjects && $this->skills;
    }

    /**
     * @return null|string
     */
    public function getFilePath()
    {
        if(!$this->file) return null;

        return '/'.Yii::app()->getModule('yupe')->uploadPath.'/'.Yii::app()->getModule('user')->uploadPath.'/'.$this->file;
    }
}
