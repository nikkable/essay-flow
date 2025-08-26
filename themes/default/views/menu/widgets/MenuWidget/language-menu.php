<?php
	$languages = $this->controller->yupe->getLanguageSelector();
 ?>

<div class="lang-box-left btn btn-secondary">
    <?= Yii::app()->language ?>

    <!--
    <?php if(count($languages) > 0): ?>
        <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/arrow.svg') ?>
    <?php endif; ?>
    -->
</div>

<?php
    $this->widget('zii.widgets.CMenu', [
        'id'=>'',
        'encodeLabel' => false,
        'items'=> []
//        'items'=> $languages
    ]);
?>
