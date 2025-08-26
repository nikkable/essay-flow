<?php
/**
 **/

$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('CurrencyModule.currency', 'Currency') => ['/currency/currencyBackend/index'],
    Yii::t('CurrencyModule.currency', 'Control'),
];


$this->pageTitle = Yii::t('CurrencyModule.currency', 'Currency - control');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CurrencyModule.currency', 'Control'), 'url' => ['/currency/currencyBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CurrencyModule.currency', 'Add'), 'url' => ['/currency/currencyBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CurrencyModule.currency', 'Currency'); ?>
        <small><?=  Yii::t('CurrencyModule.currency', 'Control'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?=  Yii::t('CurrencyModule.currency', 'Search');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
    <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('currency-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
    ?>
</div>

<br/>

<p> <?=  Yii::t('CurrencyModule.currency', 'This section provides a list'); ?>
</p>

<?php

$this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'currency-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'name',
            'slug',
            'coff',
            [
                'class' => 'yupe\widgets\EditableStatusColumn',
                'name' => 'status',
                'url' => $this->createUrl('/currency/currencyBackend/inline'),
                'source' => $model->getStatusList(),
                'options' => [
                    Currency::STATUS_PUBLISHED => ['class' => 'label-success'],
                    Currency::STATUS_DRAFT => ['class' => 'label-default'],
                ],
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
);

?>
