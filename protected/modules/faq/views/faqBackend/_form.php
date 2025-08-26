<?php
/**
 *
 *   @var $model Faq
 *   @var $form TbActiveForm
 *   @var $this FaqBackendController
 **/
$form = $this->beginWidget(
    '\yupe\widgets\ActiveForm',
    [
        'id' => 'news-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>

    <div class="alert alert-info">
        <?=  Yii::t('FaqModule.faq', 'Fields marked'); ?>
        <span class="required">*</span>
        <?=  Yii::t('FaqModule.faq', 'required.'); ?>
    </div>

    <?=  $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->datePickerGroup(
                $model,
                'date',
                [
                    'widgetOptions' => [
                        'options' => [
                            'format' => 'dd-mm-yyyy',
                            'weekStart' => 1,
                            'autoclose' => true,
                        ],
                    ],
                    'prepend' => '<i class="fa fa-calendar"></i>',
                ]
            );
            ?>
        </div>
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
            <?=  $form->textFieldGroup($model, 'title', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
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
                                'empty' => Yii::t('FaqModule.faq', '-no matter-'),
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
        <div class="col-sm-5">
            <?= $form->slugFieldGroup($model, 'slug', ['sourceAttribute' => 'title']); ?>
        </div>
        <!--
        <div class="col-sm-2">
            <?=  $form->textFieldGroup($model, 'badge', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                    ]
                ]
            ]); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->labelEx($model, 'badge_color'); ?><br>
            <?= CHtml::activeColorField($model, 'badge_color', [
                'style' => 'height: 33px; width: 92px'
            ]) ?>
        </div>
        -->
    </div>
    <div class="row">
        <div class="col-sm-9">
            <?= $form->labelEx($model, 'short_text'); ?>
            <?php $this->widget(
                $this->module->getVisualEditor(),
                [
                    'model' => $model,
                    'attribute' => 'short_text',
                ]
            ); ?>

            <?= $form->error($model, 'short_text'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9">
            <?php 
                echo $form->labelEx($model, 'full_text');
                $this->widget($this->module->getVisualEditor(),
                    [
                        'model' => $model,
                        'attribute' => 'full_text',
                    ]
                );
                echo $form->error($model, 'full_text'); 
            ?>
        </div>
    </div>
    <div class="row">
        <!--
        <div class="col-sm-9">
            <?=  $form->labelEx($model, 'field'); ?>
                <?php $this->widget(
                    'yupe\widgets\editors\Textarea',
                    [
                        'model'     => $model,
                        'attribute' => 'field',
                        'height' => 180,
                    ]
                ); ?>
            <?=  $form->error($model, 'field'); ?>
        </div>
        -->
    </div><br><br>

    <div class='row'>
        <div class="col-sm-4">
            <?= CHtml::image(
                !$model->isNewRecord && $model->image ? $model->getImageUrl(200, 200) : '#',
                $model->title,
                [
                    'class' => 'preview-image',
                    'style' => !$model->isNewRecord && $model->image ? '' : 'display:none',
                ]
            ); ?>

            <?php if (!$model->isNewRecord && $model->image): ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="delete-image"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                    </label>
                </div>
            <?php endif; ?>
            <?= $form->fileFieldGroup($model, 'image'); ?>
        </div>
    </div>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'context'    => 'primary',
            'label'      => Yii::t('FaqModule.faq', 'Save and continue'),
        ]
    ); ?>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'buttonType' => 'submit',
            'htmlOptions'=> ['name' => 'submit-type', 'value' => 'index'],
            'label'      => Yii::t('FaqModule.faq', 'Save and close'),
        ]
    ); ?>

<?php $this->endWidget(); ?>