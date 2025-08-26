<?php
/**
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('FaqModule.faq', 'Faq') => ['/faq/faqBackend/index'],
    $model->title => ['/faq/faqBackend/view', 'id' => $model->id],
    Yii::t('FaqModule.faq', 'Edit'),
];

$this->pageTitle = Yii::t('FaqModule.faq', 'Edit stock');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('FaqModule.faq', 'Control'), 'url' => ['/faq/faqBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('FaqModule.faq', 'Add'), 'url' => ['/faq/faqBackend/create']],
    ['label' => Yii::t('FaqModule.faq', 'Тег') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('FaqModule.faq', 'Edit'), 'url' => [
        '/faq/faqBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('FaqModule.faq', 'Views'), 'url' => [
        '/faq/faqBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('FaqModule.faq', 'Delete'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/faq/faqBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('FaqModule.faq', 'Are you sure you want to remove?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('FaqModule.faq', 'Edit') . ' ' . Yii::t('FaqModule.faq', 'faq'); ?>        <br/>
        <small>&laquo;<?=  $model->title; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages, 'langModels' => $langModels]); ?>