<?php

Yii::import('application.modules.other.OtherModule');

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
class VerifySendAction extends CAction
{
    public function run()
    {
        $user = $this->getController()->user;

        if(($user->author_verification_status === null || $user->author_verification_status == User::AUTHOR_VERIFICATION_REJECTED) && $user->isVerifyAuthorEnabled()) {
            $user->author_verification_status = User::AUTHOR_VERIFICATION_PENDING;

            if(!$user->save()) {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('OtherModule.other', 'Verification request sent.')
                );
            }
        }

        $this->getController()->redirect(['/user/profile/verify']);
    }
}
