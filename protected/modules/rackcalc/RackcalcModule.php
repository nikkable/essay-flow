<?php
/**
 * RackcalcModule основной класс модуля rackcalc
 *
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2024
 * @package yupe.modules.rackcalc.install
 * @since 0.1
 */

class RackcalcModule extends yupe\components\WebModule
{
    const VERSION = '1.0';

    /**
     * @var int
     */
    public $pricePage = 1;

    /**
     * Массив с именами модулей, от которых зависит работа данного модуля
     *
     * @return array
     */
    public function getDependencies()
    {
        return parent::getDependencies();
    }

    /**
     * Работоспособность модуля может зависеть от разных факторов: версия php, версия Yii, наличие определенных модулей и т.д.
     * В этом методе необходимо выполнить все проверки.
     *
     * @return array или false
     */
    public function checkSelf()
    {
        return parent::checkSelf();
    }

    /**
     * Каждый модуль должен принадлежать одной категории, именно по категориям делятся модули в панели управления
     *
     * @return string
     */
    public function getCategory()
    {
        return Yii::t('RackcalcModule.rackcalc', 'Calculator');
    }

    /**
     * массив лейблов для параметров (свойств) модуля. Используется на странице настроек модуля в панели управления.
     *
     * @return array
     */
    public function getParamsLabels()
    {
        return [
            'pricePage' => Yii::t('RackcalcModule.rackcalc', 'Price page')
        ];
    }

    /**
     * массив параметров модуля, которые можно редактировать через панель управления (GUI)
     *
     * @return array
     */
    public function getEditableParams()
    {
        return [
//            'pricePage'
        ];
    }

    /**
     * массив групп параметров модуля, для группировки параметров на странице настроек
     *
     * @return array
     */
    public function getEditableParamsGroups()
    {
        return [
            'main' => [
                'label' => Yii::t('RackcalcModule.rackcalc', 'General module settings'),
                'items' => [
//                    'pricePage',
                ],
            ],
        ];
    }

    /**
     * если модуль должен добавить несколько ссылок в панель управления - укажите массив
     *
     * @return array
     */
    public function getNavigation()
    {
        return [
            // ['label' => Yii::t('RackcalcModule.rackcalc', 'Tree')],
            // [
            //     'label' => 'Калькуляторы',
            //     'url' => ['/rackcalc/treeBackend/index'],
            // ],
            ['label' => Yii::t('RackcalcModule.rackcalc', 'Calculator')],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('RackcalcModule.rackcalc', 'Periods'),
                'url' => ['/rackcalc/periodsBackend/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Lists'),
                        'url' => ['/rackcalc/periodsBackend/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Add'),
                        'url' => ['/rackcalc/periodsBackend/create'],
                    ],
                ]
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('RackcalcModule.rackcalc', 'Subject'),
                'url' => ['/rackcalc/subjectsBackend/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Lists'),
                        'url' => ['/rackcalc/subjectsBackend/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Add'),
                        'url' => ['/rackcalc/subjectsBackend/create'],
                    ],
                ]
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('RackcalcModule.rackcalc', 'Number of pages'),
                'url' => ['/rackcalc/wordsBackend/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Lists'),
                        'url' => ['/rackcalc/wordsBackend/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Add'),
                        'url' => ['/rackcalc/wordsBackend/create'],
                    ],
                ]
            ],
            [
                'icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('RackcalcModule.rackcalc', 'Languages'),
                'url' => ['/rackcalc/languageBackend/index'],
                'items' => [
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Lists'),
                        'url' => ['/rackcalc/languageBackend/index'],
                    ],
                    [
                        'icon' => 'fa fa-fw fa-list-alt',
                        'label' => Yii::t('RackcalcModule.rackcalc', 'Add'),
                        'url' => ['/rackcalc/languageBackend/create'],
                    ],
                ]
            ]
        ];
    }

    /**
     * текущая версия модуля
     *
     * @return string
     */
    public function getVersion()
    {
        return Yii::t('RackcalcModule.rackcalc', self::VERSION);
    }

    /**
     * веб-сайт разработчика модуля или страничка самого модуля
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::t('RackcalcModule.rackcalc', 'https://vk.com/nikkable');
    }

    /**
     * Возвращает название модуля
     *
     * @return string.
     */
    public function getName()
    {
        return Yii::t('RackcalcModule.rackcalc', 'Calculator');
    }

    /**
     * Возвращает описание модуля
     *
     * @return string.
     */
    public function getDescription()
    {
        return Yii::t('RackcalcModule.rackcalc', 'Calculator');
    }

    /**
     * Имя автора модуля
     *
     * @return string
     */
    public function getAuthor()
    {
        return Yii::t('RackcalcModule.rackcalc', 'Nikkable');
    }

    /**
     * Контактный email автора модуля
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return Yii::t('RackcalcModule.rackcalc', 'monshtrina@yandex.ru');
    }

    /**
     * Ссылка, которая будет отображена в панели управления
     * Как правило, ведет на страничку для администрирования модуля
     *
     * @return string
     */
    public function getAdminPageLink()
    {
        return '/rackcalc/periodsBackend/index';
    }

    /**
     * Название иконки для меню админки, например 'user'
     *
     * @return string
     */
    public function getIcon()
    {
        return "glyphicon glyphicon-gift";
    }

    /**
      * Возвращаем статус, устанавливать ли галку для установки модуля в инсталяторе по умолчанию:
      *
      * @return bool
      **/
    public function getIsInstallDefault()
    {
        return parent::getIsInstallDefault();
    }

    /**
     * Инициализация модуля, считывание настроек из базы данных и их кэширование
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        $this->setImport(
            [
                'rackcalc.models.*',
                'rackcalc.components.*',
            ]
        );
    }

    /**
     * Массив правил модуля
     * @return array
     */
    public function getAuthItems()
    {
        return [
            [
                'name' => 'Rackcalc.RackcalcManager',
                'description' => Yii::t('RackcalcModule.rackcalc', 'Manage rackcalc'),
                'type' => AuthItem::TYPE_TASK,
                'items' => [
                    [
                        'type' => AuthItem::TYPE_OPERATION,
                        'name' => 'Rackcalc.RackcalcBackend.Index',
                        'description' => Yii::t('RackcalcModule.rackcalc', 'Index')
                    ],
                ]
            ]
        ];
    }
}
