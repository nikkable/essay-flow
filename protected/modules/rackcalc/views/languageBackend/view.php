<?php
/**
 * Отображение для view:
 *
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2024
 * @package yupe.modules.rackcalc.install
 * @since 0.1
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('RackcalcModule.rackcalc', 'Languages') => ['/rackcalc/languageBackend/index'],
    $model->id,
];

$this->pageTitle = Yii::t('RackcalcModule.rackcalc', 'View');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RackcalcModule.rackcalc', 'Control'), 'url' => ['/rackcalc/languageBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RackcalcModule.rackcalc', 'Add'), 'url' => ['/rackcalc/languageBackend/create']],
    ['label' => Yii::t('RackcalcModule.rackcalc', 'Language') . ' «' . mb_substr($model->id, 0, 32) . '»'],
    ['icon' => 'fa fa-fw fa-pencil', 'label' => Yii::t('RackcalcModule.rackcalc', 'Edit'), 'url' => [
        '/rackcalc/languageBackend/update',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-eye', 'label' => Yii::t('RackcalcModule.rackcalc', 'View'), 'url' => [
        '/rackcalc/languageBackend/view',
        'id' => $model->id
    ]],
    ['icon' => 'fa fa-fw fa-trash-o', 'label' => Yii::t('RackcalcModule.rackcalc', 'Delete'), 'url' => '#', 'linkOptions' => [
        'submit' => ['/rackcalc/languageBackend/delete', 'id' => $model->id],
        'confirm' => Yii::t('RackcalcModule.rackcalc', 'Delete?'),
        'csrf' => true,
    ]],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RackcalcModule.rackcalc', 'View'); ?>        <br/>
        <small>&laquo;<?=  $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', [
    'data'       => $model,
    'attributes' => [
        'id',
        'name',
//        'cost',
    ],
]); ?>
