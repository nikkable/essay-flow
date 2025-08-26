<?php
Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('OtherModule.other', 'Password recovery');
$this->breadcrumbs = [Yii::t('OtherModule.other', 'Password recovery')];
?>

<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id' => 'login-form',
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
            <div class="auth-box-title title"><?= Yii::t('OtherModule.other', 'Password recovery') ?></div>
            <div class="auth-box-form">
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                <?= $form->errorSummary($model); ?>

                <div class="form-group">
                    <?= $form->passwordField($model, 'password', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'New password') ]); ?>
                </div>

                <div class="form-group">
                    <?= $form->passwordField($model, 'cPassword', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Confirm new password') ]); ?>
                </div>
            </div>
            <div class="auth-box-btns">
                <button type="submit" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Change password') ?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
