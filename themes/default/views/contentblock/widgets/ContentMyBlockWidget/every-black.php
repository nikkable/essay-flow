<?php if($block): ?>
    <div class="every every--dark">
        <div class="every-head">
            <div class="every-col">
                <div class="every-desc"><?= $block->content; ?></div>
            </div>
            <div class="every-col">
                <div class="every-title title title--words"><?= $block->content2; ?></div>
            </div>
        </div>
        <div class="every-main">
            <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-black-item1', 'view' => 'every-item']); ?>
            <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-black-item2', 'view' => 'every-item']); ?>
            <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-black-item3', 'view' => 'every-item']); ?>
            <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-black-item4', 'view' => 'every-item']); ?>
        </div>
        <div class="every-foot">
            <div class="where-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/where/bg.png'; ?>"></div>
        </div>
    </div>
<?php endif; ?>
