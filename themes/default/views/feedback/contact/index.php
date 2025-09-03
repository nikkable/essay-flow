<?php
Yii::import('application.modules.other.OtherModule');
Yii::import('application.modules.feedback.FeedbackModule');
Yii::import('application.modules.install.InstallModule');

$this->title = Yii::t('OtherModule.other', 'Contacts');
$this->breadcrumbs = [Yii::t('OtherModule.other', 'Contacts')];

//throw new CHttpException(500, 'Это тестовая ошибка 500 для проверки Telegram уведомлений');
?>

<div class="container">
    <h1><?= Yii::t('OtherModule.other', 'Contacts'); ?></h1>

    <!--
    <p>Company name: Company name</p>
    <p>Company address: Company address</p>
    <p>E-mail: <a href="mailto:info@essay-flow.com">info@essay-flow.com</a></p>
    <br>
    -->

    <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

    <div class="form cart-form">
        <?php $form = $this->beginWidget(
            'bootstrap.widgets.TbActiveForm',
            [
                'id' => 'feedback-form',
                'type' => 'vertical',
                'htmlOptions' => [
                    'class' => 'well',
                ]
            ]
        ); ?>

        <?= $form->errorSummary($model); ?>

        <?php if ($model->type): ?>
            <div class='row'>
                <div class="col-sm-6">
                    <?= $form->dropDownListGroup(
                        $model,
                        'type',
                        [
                            'widgetOptions' => [
                                'data' => $module->getTypes(),
                            ],
                        ]
                    ); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class='row'>
            <div class="col-sm-6">
                <?= $form->textFieldGroup($model, 'name', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-6">
                <?= $form->textFieldGroup($model, 'email', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-6">
                <?= $form->textFieldGroup($model, 'theme', [
                    'widgetOptions' => [
                        'htmlOptions' => [
                            'class' => 'field-text',
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <div class='row'>
            <div class="col-sm-7">
                <?= $form->textAreaGroup(
                    $model,
                    'text',
                    ['widgetOptions' => ['htmlOptions' => ['rows' => 10, 'class' => 'field-textarea']]]
                ); ?>
            </div>
        </div>

        <!--
        <?php if ($module->showCaptcha && !Yii::app()->getUser()->isAuthenticated()): ?>
            <?php if (CCaptcha::checkRequirements()): ?>
                <?php $this->widget(
                    'CCaptcha',
                    [
                        'showRefreshButton' => true,
                        'imageOptions' => [
                            'width' => '150',
                        ],
                        'buttonOptions' => [
                            'class' => 'btn btn-info',
                        ],
                        'buttonLabel' => '<i class="glyphicon glyphicon-repeat"></i>',
                    ]
                ); ?>
                <div class='row'>
                    <div class="col-sm-6">
                        <?= $form->textFieldGroup(
                            $model,
                            'verifyCode',
                            [
                                'widgetOptions' => [
                                    'htmlOptions' => [
                                        'placeholder' => Yii::t(
                                            'OtherModule.other',
                                            'Insert symbols you see on image'
                                        )
                                    ],
                                ],
                            ]
                        ); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        -->

        <?= $form->hiddenField($model, 'verify'); ?>
        <div class="form-captcha">
            <div class="g-recaptcha" data-sitekey="<?= Yii::app()->params['key']; ?>"></div>
            <?= $form->error($model, 'verifyCode');?>
        </div>
        <br>

        <button class="btn btn-primary" type="submit"><?= Yii::t('OtherModule.other', 'Send message') ?></button>

        <!--
        <?php
        $this->widget(
            'bootstrap.widgets.TbButton',
            [
                'buttonType' => 'submit',
                'context' => 'primary',
                'label' => Yii::t('OtherModule.other', 'Send message'),
            ]
        ); ?>
        -->

        <?php $this->endWidget(); ?>
    </div>
</div>