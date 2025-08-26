<?php
    Yii::import('application.modules.currency.models.Currency');
?>

<div class="lang-box-left btn btn-secondary">
    <?= $this->controller->currency ?>

    <?php if(count(Currency::getCurrencyAll()) > 0): ?>
        <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/arrow.svg') ?>
    <?php endif; ?>
</div>

<?php
    $this->widget('zii.widgets.CMenu', [
        'id'=>'',
        'encodeLabel' => false,
        'items'=> Currency::getCurrencyAll(),
        'htmlOptions' => [
            'class' => 'js-currency',
        ],
    ]);
?>