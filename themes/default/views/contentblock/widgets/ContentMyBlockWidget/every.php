<?php if($block): ?>
    <div class="every" id="advantages">
        <div class="container">
            <div class="every-head">
                <div class="every-col">
                    <div class="every-desc"><?= $block->content; ?></div>
                </div>
                <div class="every-col">
                    <div class="every-title title title--words"><?= $block->content2; ?></div>
                </div>
            </div>
            <div class="every-main">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-item1', 'view' => 'every-item']); ?>
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-item2', 'view' => 'every-item']); ?>
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-item3', 'view' => 'every-item']); ?>
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-item4', 'view' => 'every-item']); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
