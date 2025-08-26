<?php
/**
 * @var $model ContentBlock
 * @var $this ContentBlockBackendController
 * @var $form \yupe\widgets\ActiveForm
 */
?>
<?php
$form = $this->beginWidget(
    'yupe\widgets\ActiveForm',
    [
        'id'                     => 'content-block-form',
        'enableAjaxValidation'   => false,
        'enableClientValidation' => true,
        'type'                   => 'vertical',
        'htmlOptions'            => ['class' => 'well', 'enctype' => 'multipart/form-data'],
    ]
); ?>
<div class="alert alert-info">
    <?=  Yii::t('ContentBlockModule.contentblock', 'Fields with'); ?>
    <span class="required">*</span>
    <?=  Yii::t('ContentBlockModule.contentblock', 'are required.'); ?>
</div>

<?=  $form->errorSummary($model); ?>

<div class="row">
    <div class="col-sm-7">
        <?=  $form->dropDownListGroup(
            $model,
            'type',
            ['widgetOptions' => ['data' => $model->getTypes()]]
        ); ?>
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
                            'empty' => Yii::t('ContentBlockModule.contentblock', '-no matter-'),
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
        <?=  $form->textFieldGroup($model, 'name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <?=  $form->slugFieldGroup($model, 'code', ['sourceAttribute' => 'name']); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <?=  $form->dropDownListGroup(
            $model,
            'category_id',
            [
                'widgetOptions' => [
                    'data'        => Yii::app()->getComponent('categoriesRepository')->getFormattedList(),
                    'htmlOptions' => [
                        'empty'               => Yii::t('ContentBlockModule.contentblock', '--choose--'),
                        'class'               => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('category_id'),
                        'data-content'        => $model->getAttributeDescription('category_id'),
                        'encode'              => false
                    ],
                ],
            ]
        ); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        <?php if (!$model->isNewRecord && $model->type == ContentBlock::HTML_TEXT): ?>
            <?=  $form->labelEx($model, 'content'); ?>
            <?php $this->widget(
                $this->yupe->getVisualEditor(),
                [
                    'model'     => $model,
                    'attribute' => 'content',
                ]
            ); ?>
            <?=  $form->error($model, 'content'); ?>
        <?php else: ?>
           <?php //Использование Mirror для лучшей визуализации ?>
             <?=  $form->labelEx($model, 'content'); ?>
                <?php $this->widget(
                    'yupe\widgets\editors\Textarea',
                    [
                        'model'     => $model,
                        'attribute' => 'content',
                    ]
                ); ?>
            <?=  $form->error($model, 'content'); ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        <?php //Использование Mirror для лучшей визуализации ?>
        <?=  $form->labelEx($model, 'content2'); ?>
        <?php $this->widget(
            'yupe\widgets\editors\Textarea',
            [
                'model'     => $model,
                'attribute' => 'content2',
            ]
        ); ?>
        <?=  $form->error($model, 'content2'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        <?php //Использование Mirror для лучшей визуализации ?>
        <?=  $form->labelEx($model, 'content3'); ?>
        <?php $this->widget(
            'yupe\widgets\editors\Textarea',
            [
                'model'     => $model,
                'attribute' => 'content3',
            ]
        ); ?>
        <?=  $form->error($model, 'content3'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        <?php //Использование Mirror для лучшей визуализации ?>
        <?=  $form->labelEx($model, 'content4'); ?>
        <?php $this->widget(
            'yupe\widgets\editors\Textarea',
            [
                'model'     => $model,
                'attribute' => 'content4',
            ]
        ); ?>
        <?=  $form->error($model, 'content4'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 form-group">
        <?=  $form->labelEx($model, 'description'); ?>
        <?php $this->widget(
            $this->yupe->getVisualEditor(),
            [
                'model'     => $model,
                'attribute' => 'description',
            ]
        ); ?>
        <?=  $form->error($model, 'description'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?=  $form->dropDownListGroup($model, 'status', ['widgetOptions' => ['data' => $model->getStatusList()]]); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-3">
        <?php
        echo CHtml::image(
            !$model->isNewRecord && $model->image ? $model->getImageUrl(150, 150) : '#',
            $model->name,
            [
                'class' => 'preview-image img-responsive',
                'style' => !$model->isNewRecord && $model->image ? '' : 'display: none',
            ]
        ); ?>

        <?php if (!$model->isNewRecord && $model->image): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="delete-image"> <?= Yii::t('YupeModule.yupe', 'Delete the file') ?>
                </label>
            </div>
        <?php endif; ?>

        <?= $form->fileFieldGroup(
            $model,
            'image',
            [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'style' => 'background-color: inherit;',
                    ],
                ],
            ]
        ); ?>
    </div>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? Yii::t(
            'ContentBlockModule.contentblock',
            'Add block and continue'
        ) : Yii::t('ContentBlockModule.contentblock', 'Save block and continue'),
    ]
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    [
        'buttonType'  => 'submit',
        'htmlOptions' => ['name' => 'submit-type', 'value' => 'index'],
        'label'       => $model->isNewRecord ? Yii::t(
            'ContentBlockModule.contentblock',
            'Add block and close'
        ) : Yii::t('ContentBlockModule.contentblock', 'Save block and close'),
    ]
); ?>

<?php $this->endWidget(); ?>
