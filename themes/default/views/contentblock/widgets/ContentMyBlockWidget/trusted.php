<?php if($block): ?>
    <div class="trusted">
        <div class="container">
            <div class="trusted-head">
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/code.png'; ?>"></div>
                <div class="trusted-title title title--words"><?= $block->content; ?></div>
            </div>
        </div>
        <div class="trusted-main">
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted1', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted2', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted3', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted4', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted5', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted6', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted7', 'view' => 'trusted-item']); ?>
            </div>
            <div class="trusted-item">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted8', 'view' => 'trusted-item']); ?>
            </div>
        </div>
        <div class="container">
            <div class="trusted-foot">
                <div class="trusted-desc">
                    <?= $block->content2; ?>
                </div>
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/image.jpg'; ?>"></div>
            </div>
        </div>
    </div>

    <!--
    <div class="trusted-item">
        <div class="trusted-item-name"><?= $block->content; ?></div>
        <div class="trusted-item-info">
            <div class="trusted-item-desc"><?= $block->content2; ?></div>
            <div class="trusted-item-icon">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/plus.svg') ?>
            </div>
        </div>
    </div>
    -->
<?php endif; ?>
