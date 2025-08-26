<?php
/**
 **/

$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('FaqModule.faq', 'Faq') => ['/faq/faqBackend/index'],
    Yii::t('FaqModule.faq', 'Control'),
];


$this->pageTitle = Yii::t('FaqModule.faq', 'Faq - control');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('FaqModule.faq', 'Control'), 'url' => ['/faq/faqBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('FaqModule.faq', 'Add'), 'url' => ['/faq/faqBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('FaqModule.faq', 'Faq'); ?>
        <small><?=  Yii::t('FaqModule.faq', 'Control'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('FaqModule.faq', 'Search');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('faq-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?=  Yii::t('FaqModule.faq', 'This section provides a list of faq'); ?>
</p>

<?php

 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'faq-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            [
                'name' => 'title',
                'type' => 'raw',
                'value' => function ($model) {
                    return CHtml::link($model->title, array("/faq/faqBackend/update", "id" => $model->id));
                },
            ],
            'slug',
            [
                'name' => 'lang',
                'value' => '$data->getFlag()',
                'filter' => $this->yupe->getLanguagesList(),
                'type' => 'html',
            ],
//            [
//                'name' => 'badge',
//                'value' => function ($model) {
//                    return $model->badge;
//                },
//                'htmlOptions' => [
//                    'class' => '',
//                ],
//            ],
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/faq/faqBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Faq::STATUS_PUBLISHED => ['class' => 'label-success'],
                    Faq::STATUS_MODERATION => ['class' => 'label-warning'],
                    Faq::STATUS_DRAFT => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
);

 ?>
