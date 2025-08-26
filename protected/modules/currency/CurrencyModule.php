<?php

use yupe\components\WebModule;

class CurrencyModule extends WebModule
{
    const VERSION = '1';

    public $currency = 'EUR';

    /**
     * @return array
     */
    public function getDependencies()
    {
        return parent::getDependencies();
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('CurrencyModule.currency', 'Store');
    }

    /**
     * @return bool
     */
    public function getInstall()
    {
        return true;
    }

    /**
     * @return array|bool
     */
    public function checkSelf()
    {
        $messages = [];

        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
    }

    /**
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'currency' => 'General currency',
        ];
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [
            'currency',
        ];
    }

    /**
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
            'main' => [
                'label' => Yii::t('CurrencyModule.currency', 'General module settings'),
                'items' => [
                    'currency',
                ],
            ],
        ];
    }

    /**
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
            ['label' => Yii::t('CurrencyModule.currency', 'Currency')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('CurrencyModule.currency', 'Currency list'),
                'url' => ['/currency/currencyBackend/index']
            ],
        ];
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * @return bool
     */
    public function getIsInstallDefault()
    {
        return true;
    }

    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('CurrencyModule.currency', 'https://vk.com/nikkable');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('CurrencyModule.currency', 'Currency');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('CurrencyModule.currency', 'Currency module');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('CurrencyModule.currency', 'Nikkable');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('CurrencyModule.currency', 'monshtrina@yandex.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/currency/currencyBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "fa fa-fw fa-pencil";
    }

    /**
     * @return bool
     */
    public function isMultiLang()
    {
        return true;
    }

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'currency.models.*',
            ]
        );
    }

    /**
     * @return array
    */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Currency.CurrencyManager',
                'description' => Yii::t('CurrencyModule.currency', 'Manage currency'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Currency.CurrencyBackend.Create',
                        'description' => Yii::t('CurrencyModule.currency', 'Creating'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Currency.CurrencyBackend.Delete',
                        'description' => Yii::t('CurrencyModule.currency', 'Removing'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Currency.CurrencyBackend.Index',
                        'description' => Yii::t('CurrencyModule.currency', 'List of'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Currency.CurrencyBackend.Update',
                        'description' => Yii::t('CurrencyModule.currency', 'Editing'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Currency.CurrencyBackend.View',
                        'description' => Yii::t('CurrencyModule.currency', 'Viewing'),
                    ],
                ],
            ],
        ];
    }
}
