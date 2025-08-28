<?php if($block): ?>
    <div class="every-item">
        <div class="every-item-col">
            <div class="every-item-label"><?= $block->content; ?></div>
        </div>
        <div class="every-item-col">
            <div class="every-item-title"><?= $block->content2; ?></div>
            <?php if($block->content3): ?>
                <div class="every-item-desc"><?= $block->content3; ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
