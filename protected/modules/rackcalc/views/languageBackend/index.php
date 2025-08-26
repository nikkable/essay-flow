<?php
/**
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2024
 * @package yupe.modules.rackcalc.install
 * @since 0.1
 **/

$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('RackcalcModule.rackcalc', 'Languages')
];

$this->pageTitle = Yii::t('RackcalcModule.rackcalc', 'Language - control');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RackcalcModule.rackcalc', 'Control'), 'url' => ['/rackcalc/languageBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RackcalcModule.rackcalc', 'Add'), 'url' => ['/rackcalc/languageBackend/create']],
];
?>

<div class="page-header">
    <h1>
        <?=  Yii::t('RackcalcModule.rackcalc', 'Language'); ?>
        <small><?=  Yii::t('RackcalcModule.rackcalc', 'control'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('RackcalcModule.rackcalc', 'Search');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
                $('.search-form form').submit(function () {
                    $.fn.yiiGridView.update('height-grid', {
                        data: $(this).serialize()
                    });

                    return false;
                });
            ");
            $this->renderPartial('_search', ['model' => $model]);
        ?>
</div>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'height-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'actionsButtons' => [
            'add' => CHtml::link(
                Yii::t('RackcalcModule.rackcalc', 'Add'),
                ['/rackcalc/languageBackend/create'],
                [
                    'class' => 'btn btn-sm btn-success pull-right',
                    // 'style' => 'margin-right:14px',
                ]
            ),
//            'batch' => CHtml::button(Yii::t('RackcalcModule.rackcalc', 'Mass actions'), [
//                'class' => 'btn btn-sm btn-primary pull-right',
//                'style' => 'margin-right:7px',
//                'data-toggle' => 'modal',
//                'data-target' => '#batch-actions',
//            ]),
        ],
        'columns'      => [
            'id',
            [
                'class'    => 'bootstrap.widgets.TbEditableColumn',
                'name'     => 'name',
                'editable' => [
                    'url'    => $this->createUrl('/rackcalc/languageBackend/inline'),
                    'mode'   => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'filter'   => CHtml::activeTextField($model, 'name', ['class' => 'form-control']),
            ],
            [
                'name' => 'lang',
                'value' => '$data->getFlag()',
                'filter' => $this->yupe->getLanguagesList(),
                'type' => 'html',
            ],
            'code',
//            [
//                'class'    => 'bootstrap.widgets.TbEditableColumn',
//                'name'     => 'cost',
//                'editable' => [
//                    'url'    => $this->createUrl('/rackcalc/languageBackend/inline'),
//                    'mode'   => 'inline',
//                    'params' => [
//                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
//                    ]
//                ],
//                'filter'   => CHtml::activeTextField($model, 'cost', ['class' => 'form-control']),
//            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>

<div class="modal fade" id="batch-actions" tabindex="-1" role="dialog" aria-labelledby="batchActions">
    <div class="modal-dialog" role="document">
        <?php
        $form = $this->beginWidget(
            '\yupe\widgets\ActiveForm',
            [
                'id' => 'batch-actions-form',
                'action' => ['/rackcalc/languageBackend/batch'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'type' => 'vertical',
            ]
        ); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="batchActions">
                    <?= Yii::t('RackcalcModule.rackcalc', 'Mass actions') ?>
                </h4>
            </div>
            <div class="modal-body">
                <div id="no-product-selected" class="alert alert-danger hidden">
                    <?= Yii::t('RackcalcModule.rackcalc', 'No one product selected') ?>
                </div>
                <div id="batch-action-error" class="alert alert-danger hidden">
                    <?= Yii::t('RackcalcModule.rackcalc', 'Something going wrong. Sorry.') ?>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->label($batchModel, 'cost') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <?= $form->dropDownList($batchModel, 'price_op', RackcalcBatchHelper::getPericeOpList(), ['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <?= $form->textField($batchModel, 'cost', ['class' => 'form-control']) ?>
                            <?= $form->error($batchModel, 'cost') ?>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <?= $form->dropDownList($batchModel, 'price_op_unit', RackcalcBatchHelper::getOpUnits(), ['class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?= Yii::t('RackcalcModule.rackcalc', 'Close') ?>
                </button>
                <button type="submit" id="batch-apply" class="btn btn-success">
                    <?= Yii::t('RackcalcModule.rackcalc', 'Apply') ?>
                </button>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
