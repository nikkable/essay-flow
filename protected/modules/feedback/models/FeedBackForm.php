<?php

Yii::import('application.modules.other.OtherModule');

/**
 * FeedBackContantsForm форма обратной связи для публичной части сайта
 *
 * @category YupeController
 * @package  yupe.modules.feedback.models
 * @author   YupeTeam <support@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @link     https://yupe.ru
 *
 **/
class FeedBackForm extends CFormModel implements IFeedbackForm
{
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $phone;
    /**
     * @var
     */
    public $theme;
    /**
     * @var
     */
    public $text;
    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $verify;
    public $verifyCode;

    /**
     * @return array
     */
    public function rules()
    {
        $module = Yii::app()->getModule('feedback');

        return [
            ['name, email, theme, text', 'required'],
            ['type', 'numerical', 'integerOnly' => true],
            ['name, email, phone', 'length', 'max' => 150],
            ['theme', 'length', 'max' => 250],
            ['email', 'email'],
            ['verify', 'safe'],
            [
                'verifyCode',
                'yupe\components\validators\YRequiredValidator',
                'allowEmpty' => !$module->showCaptcha || Yii::app()->getUser()->isAuthenticated(),
            ],
            [
                'verifyCode',
                'captcha',
                'allowEmpty' => !$module->showCaptcha || Yii::app()->getUser()->isAuthenticated(),
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('OtherModule.other', 'Your name'),
            'email' => Yii::t('OtherModule.other', 'Email'),
            'phone' => Yii::t('OtherModule.other', 'Phone'),
            'theme' => Yii::t('OtherModule.other', 'Topic'),
            'text' => Yii::t('OtherModule.other', 'Text'),
            'verifyCode' => Yii::t('OtherModule.other', 'Check code'),
            'type' => Yii::t('OtherModule.other', 'Type'),
        ];
    }

    public function beforeValidate(){
        if ($_POST['g-recaptcha-response']=='') {
            $this->addError('verifyCode', Yii::t('OtherModule.other', 'Please complete the security check.'));
        } else {
            $ip = CHttpRequest::getUserHostAddress();
            $post = [
                'secret' => Yii::app()->params['secretkey'],
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $ip,
            ];

            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $response = CJSON::decode($response);
            if (isset($response['success']) and isset($response['error-codes']) and $response['success']===false) {
                $this->addError('verifyCode', implode(', ', $response['error-codes']));
            }
        }
        return parent::beforeValidate();
    }

    /**
     * Список возможных типов:
     *
     * @return array
     */
    public function getTypeList()
    {
        $types = Yii::app()->getModule('feedback')->types;

        if ($types) {
            $types[FeedBack::TYPE_DEFAULT] = Yii::t('FeedbackModule.feedback', 'Default');
        } else {
            $types = [FeedBack::TYPE_DEFAULT => Yii::t('FeedbackModule.feedback', 'Default')];
        }

        return $types;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
