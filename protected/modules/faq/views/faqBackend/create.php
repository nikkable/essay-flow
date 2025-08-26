<?php
/**
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('FaqModule.faq', 'Faq') => ['/faq/faqBackend/index'],
    Yii::t('FaqModule.faq', 'Add'),
];

$this->pageTitle = Yii::t('faqModule.faq', 'Add');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('FaqModule.faq', 'Control'), 'url' => ['/faq/faqBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('faqModule.faq', 'Add'), 'url' => ['/faq/faqBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('faqModule.faq', 'Faq'); ?>
        <small><?=  Yii::t('FaqModule.faq', 'Add'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages]); ?>