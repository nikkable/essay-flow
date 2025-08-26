<?php
/**
 * @var TbActiveForm $form
 */

Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('OtherModule.other', 'Password recovery');
$this->breadcrumbs = [Yii::t('OtherModule.other', 'Password recovery')];
?>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'registration-form',
        'type' => 'vertical',
        'htmlOptions' => [
            'class' => 'well',
        ]
    ]
); ?>

<div class="auth">
    <div class="auth-main">
        <div class="auth-box">
            <a href="/" class="auth-box-back">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/arrow-prev.svg') ?>
                <?= Yii::t('OtherModule.other', 'Back') ?>
            </a>
            <div class="auth-box-title title"><?= Yii::t('OtherModule.other', 'Recovery') ?></div>
            <div class="auth-box-form">
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                <?= $form->errorSummary($model); ?>

                <p><?= Yii::t('OtherModule.other', Yii::t('OtherModule.other', 'Enter an email you have used during signup')) ?></p>
                <div class="form-group">
                    <?= $form->textField($model, 'email', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Email') ]); ?>
                </div>

                <p><?= CHtml::link(Yii::t('OtherModule.other', 'Login'), ['/user/account/login']) ?></p>

                <br>
            </div>
            <div class="auth-box-btns">
                <button type="submit" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Recover password') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
