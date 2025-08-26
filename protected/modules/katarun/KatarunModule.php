<?php

use yupe\components\WebModule;

/**
 * Class KatarunModule
 */
class KatarunModule extends WebModule
{
    /**
     *
     */
    const VERSION = '0.9.95';

    /**
     * @return array
     */
    public function getDependencies()
    {
        return ['payment'];
    }

    /**
     * @return bool
     */
    public function getNavigation()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getAdminPageLink()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function getIsShowInAdminMenu()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('KatarunModule.katarun', 'Store');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Yii::t('KatarunModule.katarun', 'Katarun');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return Yii::t('KatarunModule.katarun', 'Katarun payment module');
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('KatarunModule.katarun', 'Nikkable');
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('KatarunModule.katarun', 'monshtrina@yandex.ru');
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('KatarunModule.katarun', 'https://vk.com/nikkable');
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return 'fa fa-rub';
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

}
