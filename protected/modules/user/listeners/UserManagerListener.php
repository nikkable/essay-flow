<?php

Yii::import('application.modules.notify.models.NotifySettings');
Yii::import('application.components.Telegram');

/**
 * Class UserManagerListener
 */
class UserManagerListener
{
    /**
     * @param UserRegistrationEvent $event
     */
    public static function onUserRegistration(UserRegistrationEvent $event)
    {
        Yii::app()->notify->send(
            $event->getUser(),
            Yii::t(
                'UserModule.user',
                'Registration on {site}',
                ['{site}' => Yii::app()->getModule('yupe')->siteName]
            ),
            '//user/email/successRegistrationEmail',
            [
                'token' => $event->getToken(),
                'user' => $event->getUser(),
                'event' => $event,
            ]
        );
    }

    /**
     * @param UserRegistrationEvent $event
     */
    public static function onUserRegistrationNeedActivation(UserRegistrationEvent $event)
    {
        Yii::app()->notify->send(
            $event->getUser(),
            Yii::t(
                'UserModule.user',
                'Registration on {site}',
                ['{site}' => Yii::app()->getModule('yupe')->siteName]
            ),
            '//user/email/needAccountActivationEmail',
            [
                'token' => $event->getToken(),
                'user' => $event->getUser(),
                'event' => $event,
            ]
        );
    }

    /**
     * @param UserPasswordRecoveryEvent $event
     */
    public static function onPasswordRecovery(UserPasswordRecoveryEvent $event)
    {
        Yii::app()->notify->send(
            $event->getUser(),
            Yii::t('UserModule.user', 'Password recovery!'),
            '//user/email/passwordRecoveryEmail',
            [
                'token' => $event->getToken(),
                'user' => $event->getUser(),
                'event' => $event,
            ]
        );
    }

    /**
     * @param UserActivatePasswordEvent $event
     */
    public static function onSuccessActivatePassword(UserActivatePasswordEvent $event)
    {
        if (true === $event->getNotify()) {
            Yii::app()->notify->send(
                $event->getUser(),
                Yii::t('UserModule.user', 'Your password was changed successfully!'),
                '//user/email/passwordRecoverySuccessEmail',
                [
                    'password' => $event->getPassword(),
                    'user' => $event->getUser(),
                    'event' => $event,
                ]
            );
        }
    }

    public static function onSuccessActivateAccount(UserActivateEvent $event)
    {
        $user = $event->getUser();

        if (null !== $user) {
            $notify = new NotifySettings;
            $notify->user_id = $user->id;
            $notify->save();

            $sql = "
                SELECT ur.itemname AS role
                FROM yupe_user_user u
                JOIN yupe_user_user_auth_assignment ur ON ur.userid = u.id
                WHERE u.id = :userId
            ";

            $result = Yii::app()->db->createCommand($sql)->queryRow(true, [':userId' => $user->id]);

            $message = "Сайт Essay Flow: \n";
            $message .= "Регистрация нового пользователя c ID " . $user->id . " \n";
            $message .= "Email: " . $user->email . "\n";
            $message .= $result && isset($result['role']) && $result['role'] === 'author' ? "Роль: Автор" : "Роль: Пользователь";

            $telegram = new Telegram();
            $telegram->send($message);
        }
    }

    /**
     * @param UserEmailConfirmEvent $event
     */
    public static function onSuccessEmailChange(UserEmailConfirmEvent $event)
    {
        Yii::app()->notify->send(
            $event->getUser(),
            Yii::t('UserModule.user', 'Email verification'),
            '//user/email/needEmailActivationEmail',
            [
                'token' => $event->getToken(),
                'user' => $event->getUser(),
                'event' => $event,
            ]
        );
    }

    /**
     * @param UserEmailConfirmEvent $event
     */
    public static function onSuccessEmailConfirm(UserEmailConfirmEvent $event)
    {
        Yii::app()->notify->send(
            $event->getUser(),
            Yii::t('UserModule.user', 'Email verification'),
            '//user/email/emailConfirmSuccessEmail',
            [
                'token' => $event->getToken(),
                'user' => $event->getUser(),
                'event' => $event,
            ]
        );
    }
}
