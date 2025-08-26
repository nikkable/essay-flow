<?php
/**
 *
 *   @var $model Currency
 *   @var $form TbActiveForm
 *   @var $this CurrencyBackendController
 **/
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'news-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'well'],
    ]
); ?>

    <div class="alert alert-info">
        <?=  Yii::t('CurrencyModule.currency', 'Fields marked'); ?>
        <span class="required">*</span>
        <?=  Yii::t('CurrencyModule.currency', 'required.'); ?>
    </div>

    <?=  $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->dropDownListGroup(
                $model,
                'status',
                [
                    'widgetOptions' => [
                        'data' => $model->getStatusList(),
                    ],
                ]
            ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'name', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <?=  $form->textFieldGroup($model, 'slug', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <?=  $form->textFieldGroup($model, 'coff', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('CurrencyModule.currency', 'Save and continue'),
        ]
    ); ?>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('CurrencyModule.currency', 'Save and close'),
        ]
    ); ?>

<?php $this->endWidget(); ?>