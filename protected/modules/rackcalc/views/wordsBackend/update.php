<?php
/**
 * Отображение для update:
 *
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2024
 * @package yupe.modules.rackcalc.install
 * @since 0.1
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('RackcalcModule.rackcalc', 'Number of pages') => ['/rackcalc/wordsBackend/index'],
    $model->id => ['/rackcalc/wordsBackend/view', 'id' => $model->id],
    Yii::t('RackcalcModule.rackcalc', 'Edit'),
];

$this->pageTitle = Yii::t('RackcalcModule.rackcalc', 'Edits');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RackcalcModule.rackcalc', 'Control Number of pages'), 'url' => ['/rackcalc/wordsBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RackcalcModule.rackcalc', 'Add'), 'url' => ['/rackcalc/wordsBackend/create']],
    ['label' => Yii::t('RackcalcModule.rackcalc', 'Number of pages') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('RackcalcModule.rackcalc', 'Edit'), 'url' => [
        '/rackcalc/wordsBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('RackcalcModule.rackcalc', 'View'), 'url' => [
        '/rackcalc/wordsBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('RackcalcModule.rackcalc', 'Delete'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/rackcalc/wordsBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('RackcalcModule.rackcalc', 'Delete?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RackcalcModule.rackcalc', 'Edits'); ?>        <br/>
        <small>&laquo;<?=  $model->id; ?>&raquo;</small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages]); ?>