<?php

/**
 * Экшн для переключения роли автора
 *
 * @category YupeComponents
 * @package  yupe.modules.user.controllers.profile
 */
class ToggleAuthorRoleAction extends CAction
{
    public function run()
    {
        $user = $this->getController()->user;

        if ($user === null) {
            throw new CHttpException(403, Yii::t('UserModule.user', 'User not found.'));
        }

//        if ($user->author_verification_status != User::AUTHOR_VERIFICATION_VERIFIED) {
//            Yii::app()->getUser()->setFlash(
//                yupe\widgets\YFlashMessages::ERROR_MESSAGE,
//                Yii::t('UserModule.user', 'Author role can be changed only after full verification.')
//            );
//            $this->getController()->redirect(['/user/profile/profile']);
//        }

        $request = Yii::app()->getRequest();
        $enable = (int)$request->getParam('enable') === 1;

        $authManager = Yii::app()->authManager;
        $userId = $user->id;

        $hasAuthorRole = $authManager->isAssigned('author', $userId);

        if ($enable && !$hasAuthorRole) {
            $authManager->assign('author', $userId);
            Yii::app()->getUser()->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('UserModule.user', 'Author role enabled')
            );
        } elseif (!$enable && $hasAuthorRole) {
            $authManager->revoke('author', $userId);
            Yii::app()->getUser()->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t('UserModule.user', 'Author role disabled')
            );
        }

        Yii::app()->getCache()->delete('YAdminPanel::' . $userId . '::' . Yii::app()->getLanguage());
        Yii::app()->getCache()->delete(Yii::app()->getUser()->rbacCacheNameSpace . $userId);

        $this->getController()->redirect(['/user/profile/profile']);
    }
}
