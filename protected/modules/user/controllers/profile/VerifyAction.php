<?php
/**
 * Экшн, отвечающий за редактирование профиля пользователя
 *
 * @category YupeComponents
 * @package  yupe.modules.user.controllers.account
 * @author   YupeTeam <support@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.7
 * @link     https://yupe.ru
 *
 **/
class VerifyAction extends CAction
{
    public function run()
    {
        $user = $this->getController()->user;

        $this->getController()->render(
            'verify',
            [
                'module' => Yii::app()->getModule('user'),
                'user' => $user
            ]
        );
    }
}
