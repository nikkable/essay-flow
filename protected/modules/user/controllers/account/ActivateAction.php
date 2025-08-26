<?php

Yii::import('application.modules.other.OtherModule');
/**
 * Экшн, отвечающий за активацию аккаунта пользователя
 *
 * @category YupeComponents
 * @package  yupe.modules.user.controllers.account
 * @author   YupeTeam <support@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.7
 * @link     https://yupe.ru
 *
 **/

use yupe\helpers\Url;

class ActivateAction extends CAction
{
    public function run($token)
    {
        $module = Yii::app()->getModule('user');

        // Пытаемся найти пользователя по токену,
        // в противном случае - ошибка:
        if (Yii::app()->userManager->activateUser($token)) {

            // Сообщаем пользователю:
            Yii::app()->getUser()->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('OtherModule.other', 'Account activated! You can log in now!')
            );

            // Выполняем переадресацию на соответствующую страницу:
            $this->getController()->redirect(Url::redirectUrl($module->accountActivationSuccess));
        }

        // Сообщаем об ошибке:
        Yii::app()->getUser()->setFlash(
            yupe\widgets\YFlashMessages::ERROR_MESSAGE,
            Yii::t(
                'OtherModule.other',
                'There was a problem with the activation of the account. Please refer to the site\'s administration.'
            )
        );

        // Переадресовываем на соответствующую ошибку:
        $this->getController()->redirect(Url::redirectUrl($module->accountActivationFailure));
    }
}
