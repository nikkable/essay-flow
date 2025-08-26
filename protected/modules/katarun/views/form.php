<?php
/**
 * @var string $action Form action url
 * @var string $sessionId
 */
?>
<?= CHtml::beginForm($action, 'GET') ?>
<?= CHtml::submitButton(Yii::t('KatarunModule.katarun','Pay')) ?>
<?= CHtml::endForm() ?>