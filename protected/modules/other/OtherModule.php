<?php
class OtherModule extends yupe\components\WebModule
{
    /**
     *
     */
    const VERSION = '1.0';

    /**
     * показать или нет модуль в панели управления
     *
     * @return bool
     */
    public function getIsShowInAdminMenu()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('OtherModule.other', 'Other');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Yii::t('OtherModule.other', 'Other');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return Yii::t('OtherModule.other', 'Module for create simple');
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('OtherModule.other', 'Nikkable');
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('OtherModule.other', 'monshtrina@yandex.ru');
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('OtherModule.other', 'https://vk.com/nikkable');
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-th-large";
    }

    /**
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/other/otherBackend/index';
    }

    /**
     * @return bool
     */
    public function getIsInstallDefault()
    {
        return false;
    }
}
