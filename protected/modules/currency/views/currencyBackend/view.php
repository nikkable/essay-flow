<?php
/**
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('CurrencyModule.currency', 'Currency') => ['/currency/currencyBackend/index'],
    $model->title,
];

$this->pageTitle = Yii::t('CurrencyModule.currency', 'Views');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CurrencyModule.currency', 'Control'), 'url' => ['/currency/currencyBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CurrencyModule.currency', 'Add'), 'url' => ['/currency/currencyBackend/create']],
    ['label' => Yii::t('CurrencyModule.currency', 'Currency') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('CurrencyModule.currency', 'Edit'), 'url' => [
        '/currency/currencyBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('CurrencyModule.currency', 'Views'), 'url' => [
        '/currency/currencyBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('CurrencyModule.currency', 'Delete'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/currency/currencyBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('CurrencyModule.currency', 'Are you sure you want to remove?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CurrencyModule.currency', 'View'); ?>        <br/>
        <small>&laquo;<?=  $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'name',
        'slug',
        'coff',
    ],
]); ?>
