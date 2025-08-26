<?php
/**
 * Отображение для _form:
 *
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2024
 * @package yupe.modules.rackcalc.install
 * @since 0.1
 *
 *
 *   @var $model Periods
 *   @var $form TbActiveForm
 *   @var $this PeriodsBackendController
 **/
$form = $this->beginWidget(
    'yupe\widgets\ActiveForm', [
        'id'                     => 'periods-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'htmlOptions'            => ['class' => 'well'],
    ]
);
?>

<div class="alert alert-info">
    <?=  Yii::t('RackcalcModule.rackcalc', 'Field'); ?>
    <span class="required">*</span>
    <?=  Yii::t('RackcalcModule.rackcalc', 'required.'); ?>
</div>

<?=  $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'name', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('name'),
                        'data-content' => $model->getAttributeDescription('name')
                    ]
                ]
            ]); ?>
        </div>
        <div class="col-sm-2">
            <?php if (count($languages) > 1): { ?>
                <?= $form->dropDownListGroup(
                    $model,
                    'lang',
                    [
                        'widgetOptions' => [
                            'data' => $languages,
                            'htmlOptions' => [
                                'empty' => Yii::t('RackcalcModule.rackcalc', '-no matter-'),
                            ],
                        ],
                    ]
                ); ?>
            <?php } else: { ?>
                <?= $form->hiddenField($model, 'lang'); ?>
            <?php } endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->slugFieldGroup(
                $model,
                'code',
                [
                    'sourceAttribute' => 'name',
                    'widgetOptions'   => [
                        'htmlOptions' => [
                            'class'               => 'popover-help',
                            'data-original-title' => $model->getAttributeLabel('code'),
                            'data-content'        => $model->getAttributeDescription('code'),
                        ],
                    ],
                ]
            ); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textFieldGroup($model, 'cost', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('cost'),
                        'data-content' => $model->getAttributeDescription('cost')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textAreaGroup($model, 'desc', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('desc'),
                        'data-content' => $model->getAttributeDescription('desc')
                    ]
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <?=  $form->textAreaGroup($model, 'desc_small', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('desc_small'),
                        'data-content' => $model->getAttributeDescription('desc_small')
                    ]
                ]
            ]); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('RackcalcModule.rackcalc', 'Save and continue'),
        ]
    ); ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('RackcalcModule.rackcalc', 'Save and close'),
        ]
    ); ?>

<?php $this->endWidget(); ?>