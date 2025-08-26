<?php
/**
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('CurrencyModule.Currency', 'Currency') => ['/currency/currencyBackend/index'],
    Yii::t('CurrencyModule.Currency', 'Add'),
];

$this->pageTitle = Yii::t('CurrencyModule.currency', 'Add');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('CurrencyModule.Currency', 'Control'), 'url' => ['/currency/currencyBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('CurrencyModule.currency', 'Add'), 'url' => ['/currency/currencyBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('CurrencyModule.currency', 'Currency'); ?>
        <small><?=  Yii::t('CurrencyModule.Currency', 'Add'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model]); ?>