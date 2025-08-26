<?php if($block): ?>
    <div class="trusted-item">
        <div class="trusted-item-name"><?= $block->content; ?></div>
        <div class="trusted-item-info">
            <div class="trusted-item-desc"><?= $block->content2; ?></div>
            <div class="trusted-item-icon">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/plus.svg') ?>
            </div>
        </div>
    </div>
<?php endif; ?>
