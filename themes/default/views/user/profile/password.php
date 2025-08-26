<?php
/* @var $model ProfileForm */

Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('OtherModule.other', 'Change password');
$this->breadcrumbs = [
    Yii::t('OtherModule.other', 'User profile') => ['/user/profile/profile'],
    Yii::t('OtherModule.other', 'Change password')
];

Yii::app()->clientScript->registerScript(
    'show-password',
    "$(function () {
    $('#show_pass').click(function () {
        $('#ProfilePasswordForm_password').prop('type', $(this).prop('checked') ? 'text' : 'password');
        $('#ProfilePasswordForm_cPassword').prop('type', $(this).prop('checked') ? 'text' : 'password');
    });
});"
);

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    [
        'id'                     => 'profile-password-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => false,
        'htmlOptions'            => [
            'class' => 'well',
        ]
    ]
);
?>

<div class="container m-t-5 m-b-5">
    <h1><?= Yii::t('OtherModule.other', 'Change password'); ?></h1>

    <div class="form cart-form">
        <?= $form->errorSummary($model); ?>

        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->passwordFieldGroup(
                    $model,
                    'password',
                    ['widgetOptions' => [
                        'htmlOptions' => [
                            'autocomplete' => 'off',
                            'class' => 'field-text'
                        ]
                    ]]
                ); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 col-xl-3">
                <?= $form->passwordFieldGroup(
                    $model,
                    'cPassword',
                    ['widgetOptions' => [
                        'htmlOptions' => [
                            'autocomplete' => 'off',
                            'class' => 'field-text'
                        ]
                    ]]
                ); ?>
            </div>
        </div>
        <div class="row m-b-5">
            <div class="col-12 col-md-4 col-xl-3">
                <label class="checkbox">
                    <input type="checkbox" value="1" id="show_pass"> <?= Yii::t('OtherModule.other', 'Show password') ?>
                </label>
            </div>
        </div>

        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType' => 'submit',
                'context'    => 'primary',
                'label'      => Yii::t('OtherModule.other', 'Change password'),
            ]
        ); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>
