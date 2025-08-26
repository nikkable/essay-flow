<?php
/**
 * Базовый класс для всех контроллеров публичной части
 *
 * @category YupeComponents
 * @package  yupe.modules.yupe.components.controllers
 * @author   YupeTeam <support@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @version  0.6
 * @link     https://yupe.ru
 **/

namespace yupe\components\controllers;

use Currency;
use Yii;
use yupe\events\YupeControllerInitEvent;
use yupe\events\YupeEvents;
use application\components\Controller;

Yii::import('application.modules.currency.models.Currency');
Yii::import('application.modules.other.OtherModule');

/**
 * Class FrontController
 * @package yupe\components\controllers
 */
abstract class FrontController extends Controller
{
    public $mainAssets;

    public $currency = 'EUR';

    public $currencyCoff = 1;

    /**
     * Вызывается при инициализации FrontController
     * Присваивает значения, необходимым переменным
     */
    public function init()
    {
        Yii::app()->eventManager->fire(YupeEvents::BEFORE_FRONT_CONTROLLER_INIT, new YupeControllerInitEvent($this, Yii::app()->getUser()));

        parent::init();

        Yii::app()->theme = $this->yupe->theme ?: 'default';

        $this->mainAssets = Yii::app()->getTheme()->getAssetsUrl();

        $bootstrap = Yii::app()->getTheme()->getBasePath() . DIRECTORY_SEPARATOR . "bootstrap.php";

        if (is_file($bootstrap)) {
            require $bootstrap;
        }
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'InlineWidgetsBehavior' => [
                'class' => 'yupe.components.behaviors.InlineWidgetsBehavior',
                'classSuffix' => 'Widget',
                'startBlock' => '[[w:',
                'endBlock' => ']]',
                'widgets' => Yii::app()->params['runtimeWidgets'],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if(isset($_COOKIE["currency"])) {
            $this->currency = $_COOKIE["currency"];
        }

        if($this->currency !== 'EUR') {
            $currency = Currency::model()->findByAttributes(['slug' => $this->currency]);

            if($currency) {
                $this->currencyCoff = $currency->coff;
            }
        }

        return parent::beforeAction($action);
    }
}
