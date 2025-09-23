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
    Congratulations! 🎉
    Your profile has been successfully verified. You can now start accepting and fulfilling orders.
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
