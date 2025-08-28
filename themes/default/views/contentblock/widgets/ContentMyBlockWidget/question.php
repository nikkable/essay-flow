<?php if($block): ?>
    <div class="container">
        <div class="question-head">
            <div class="question-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/question/image.jpg'; ?>"></div>
            <div class="question-title title title--words"><?= $block->content; ?></div>
        </div>
    </div>
    <div class="question-main">
        <?php $this->widget('application.modules.faq.widgets.FaqWidget'); ?>
    </div>
<?php endif; ?>
