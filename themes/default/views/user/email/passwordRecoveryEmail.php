<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?= Yii::t(
            'UserModule.user',
            'Reset password for site "{site}"',
            [
                '{site}' => CHtml::encode(Yii::app()->getModule('yupe')->siteName)
            ]
        ); ?>
    </title>
</head>
<body>
<p>
    <?= Yii::t(
        'UserModule.user',
        'Reset password for site "{site}"',
        [
            '{site}' => CHtml::encode(Yii::app()->getModule('yupe')->siteName)
        ]
    ); ?>
</p>

<p>
    <?= Yii::t(
        'UserModule.user',
        'It looks like you requested a password reset for "{site}"',
        [
            '{site}' => CHtml::encode(Yii::app()->getModule('yupe')->siteName)
        ]
    ); ?>
</p>

<p>
    <?= Yii::t(
        'UserModule.user',
        "If this wasn't you, simply ignore this email."
    ); ?>
</p>

<p>
    <?= Yii::t(
        'UserModule.user',
        'For password recovery, please follow this :link',
        [
            ':link' => CHtml::link(
                Yii::t('UserModule.user', 'link'),
                $link = $this->createAbsoluteUrl(
                    '/user/account/restore',
                    [
                        'token' => $token->token,
                    ]
                )
            ),
        ]
    ); ?>
</p>

<!--
<p><?= $link; ?></p>
-->

<hr/>

<?= Yii::t(
    'UserModule.user',
    'Best regards, "{site}" administration!',
    [
        '{site}' => CHtml::encode(Yii::app()->getModule('yupe')->siteName)
    ]
); ?>
</body>
</html>
