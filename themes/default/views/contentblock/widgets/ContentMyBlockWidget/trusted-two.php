<?php if($block): ?>
    <div class="trusted">
        <div class="container">
            <div class="trusted-head">
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/code.png'; ?>"></div>
                <div class="trusted-title title title--words"><?= $block->content; ?></div>
            </div>
            <div class="trusted-main">
                <div class="trusted-item">
                    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted-two-item1', 'view' => 'trusted-item']); ?>
                </div>
                <div class="trusted-item">
                    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted-two-item2', 'view' => 'trusted-item']); ?>
                </div>
                <div class="trusted-item">
                    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted-two-item3', 'view' => 'trusted-item']); ?>
                </div>
            </div>
            <div class="trusted-foot">
                <div class="trusted-desc">
                    <?= $block->content2; ?>
                </div>
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/image2.jpg'; ?>"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
