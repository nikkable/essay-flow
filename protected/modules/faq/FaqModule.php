<?php

use yupe\components\WebModule;

class FaqModule extends WebModule
{
    const VERSION = '1';

    /**
     * @var string
     */
    public $uploadPath = 'faq';
    public $uploadPathBgStock = 'faq-bg';
    /**
     * @var string
     */
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    /**
     * @var int
     */
    public $minSize = 0;
    /**
     * @var int
     */
    public $maxSize = 5368709120;
    /**
     * @var int
     */
    public $maxFiles = 1;

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
        return Yii::t('FaqModule.faq', 'Content');
    }

    /**
     * @return bool
     */
    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir(Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath, 0755);
        }

        return false;
    }

    /**
     * @return array|bool
     */
    public function checkSelf()
    {
        $messages = [];

        $uploadPath = Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;

        if (!is_writable($uploadPath)) {
            $messages[WebModule::CHECK_ERROR][] = [
                'type' => WebModule::CHECK_ERROR,
                'message' => Yii::t(
                    'FaqModule.faq',
                    'Directory "{dir}" is not accessible for write! {link}',
                    [
                        '{dir}' => $uploadPath,
                        '{link}' => CHtml::link(
                            Yii::t('FaqModule.faq', 'Change settings'),
                            [
                                '/yupe/backend/modulesettings/',
                                'module' => 'faq',
                            ]
                        ),
                    ]
                ),
            ];
        }

        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
    }

    /**
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'editor' => Yii::t('FaqModule.faq', 'Visual editor'),
            'uploadPath' => Yii::t(
                'FaqModule.faq',
                'Uploading files catalog (relatively {path})',
                [
                    '{path}' => Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . Yii::app()->getModule(
                            "yupe"
                        )->uploadPath,
                ]
            ),
            'allowedExtensions' => Yii::t('FaqModule.faq', 'Accepted extensions (separated by comma)'),
            'minSize' => Yii::t('FaqModule.faq', 'Minimum size (in bytes)'),
            'maxSize' => Yii::t('FaqModule.faq', 'Maximum size (in bytes)'),
        ];
    }

    /**
     * @return array
     */
    public function getEditableParams()
    {
        return [
//            'editor' => Yii::app()->getModule('yupe')->getEditors(),
//            'uploadPath',
            'allowedExtensions',
            'minSize',
            'maxSize',
        ];
    }

    /**
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
//            'main' => [
//                'label' => Yii::t('FaqModule.faq', 'General module settings'),
//                'items' => [
//                    'editor',
//                ],
//            ],
            'images' => [
                'label' => Yii::t('FaqModule.faq', 'Faq settings'),
                'items' => [
//                    'uploadPath',
                    'allowedExtensions',
                    'minSize',
                    'maxSize',
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
            ['label' => Yii::t('FaqModule.faq', 'Faq')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('FaqModule.faq', 'Faq list'),
                'url' => ['/faq/faqBackend/index']
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
        return Yii::t('FaqModule.faq', 'https://vk.com/nikkable');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('FaqModule.faq', 'Faq');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('FaqModule.faq', 'Online store faq module');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('FaqModule.faq', 'nikkable');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('FaqModule.faq', 'monshtrina@yandex.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/faq/faqBackend/index';
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
                'faq.models.*',
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
                'name' => 'Faq.FaqManager',
                'description' => Yii::t('FaqModule.faq', 'Manage stocks'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Faq.FaqBackend.Create',
                        'description' => Yii::t('FaqModule.faq', 'Creating'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Faq.FaqBackend.Delete',
                        'description' => Yii::t('FaqModule.faq', 'Removing'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Faq.FaqBackend.Index',
                        'description' => Yii::t('FaqModule.faq', 'List of'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Faq.FaqBackend.Update',
                        'description' => Yii::t('FaqModule.faq', 'Editing'),
                    ],
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Faq.FaqBackend.View',
                        'description' => Yii::t('FaqModule.faq', 'Viewing'),
                    ],
                ],
            ],
        ];
    }
}
