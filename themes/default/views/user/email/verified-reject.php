<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?= Yii::t(
            'UserModule.user',
            'Verification Successful for site "{site}"',
            [
                '{site}' => CHtml::encode(Yii::app()->getModule('yupe')->siteName)
            ]
        ); ?>
    </title>
</head>
<body>
<p>
    We’re sorry. Unfortunately, your profile verification was not successful this time. Please review your details and try again.
    <!--
    <?= Yii::t(
        'UserModule.user',
        'Reset password for site "{site}"',
        [
            '{site}' => CHtml::encode(Yii::app()->getModule('yupe')->siteName)
        ]
    ); ?>
    -->
</p>
</body>
</html>
