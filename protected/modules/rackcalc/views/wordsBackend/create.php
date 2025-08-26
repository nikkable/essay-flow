<?php
/**
 * Отображение для create:
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
    Yii::t('RackcalcModule.rackcalc', 'Add'),
];

$this->pageTitle = Yii::t('RackcalcModule.rackcalc', 'Added');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('RackcalcModule.rackcalc', 'Control Number of pages'), 'url' => ['/rackcalc/wordsBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('RackcalcModule.rackcalc', 'Add'), 'url' => ['/rackcalc/wordsBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?=  Yii::t('RackcalcModule.rackcalc', 'Number of pages'); ?>
        <small><?=  Yii::t('RackcalcModule.rackcalc', 'adds'); ?></small>
    </h1>
</div>

<?=  $this->renderPartial('_form', ['model' => $model, 'languages' => $languages]); ?>