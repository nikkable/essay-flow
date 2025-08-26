<?php
Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('OtherModule.other', 'Login');
$this->breadcrumbs = [Yii::t('OtherModule.other', 'Login')];
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
            <div class="auth-box-title title"><?= Yii::t('OtherModule.other', 'Login') ?></div>
            <div class="auth-box-form">
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                <?= $form->errorSummary($model); ?>

                <div class="form-group">
                    <?= $form->textField($model, 'email', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Email') ]); ?>
                </div>
                <div class="form-group">
                    <?= $form->passwordField($model, 'password', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Password') ]); ?>
                </div>

                <?php if ($this->getModule()->sessionLifeTime > 0): { ?>
                    <?= $form->checkBoxGroup($model, 'remember_me', [
                        'widgetOptions' => [
                            'htmlOptions' => [
                                'checked' => true
                            ]
                        ]
                    ]); ?>
                <?php } endif; ?>

                <?php if (Yii::app()->getUser()->getState('badLoginCount', 0) >= 3 && CCaptcha::checkRequirements('gd')): { ?>
                    <?= $form->textFieldGroup(
                        $model,
                        'verifyCode',
                        ['hint' => Yii::t('OtherModule.other', 'Please enter the text from the image')]
                    ); ?>
                    <?php $this->widget(
                        'CCaptcha',
                        [
                            'showRefreshButton' => true,
                            'imageOptions' => [
                                'width' => '150',
                            ],
                            'buttonOptions' => [
                                'class' => 'btn btn-default',
                            ],
                            'buttonLabel' => '<i class="glyphicon glyphicon-repeat"></i>',
                        ]
                    ); ?>
                <?php } endif; ?>

                <p><?= CHtml::link(Yii::t('OtherModule.other', 'Register'), ['/user/account/registration']) ?></p>
                <p><?= CHtml::link(Yii::t('OtherModule.other', 'Forgot your password?'), ['/user/account/recovery']) ?></p>

                <br>
            </div>
            <div class="auth-box-btns">
                <button type="submit" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Login') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->endWidget(); ?>
