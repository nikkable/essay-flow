<?php if($block): ?>
    <div class="trusted">
        <div class="container">
            <div class="trusted-head">
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/code.png'; ?>"></div>
                <div class="trusted-title title title--words"><span class="text-bg"><span>Breaking</span><span>barriers</span><span>in content creation —</span></span><span>Simplicity</span><span>Without</span><span>sacrificing</span><span>strength.</span></div>
            </div>
            <div class="trusted-main">
                <div class="trusted-item">Effortless. Impactful. Yours.</div>
                <div class="trusted-item">Redefined</div>
                <div class="trusted-item">Simple</div>
            </div>
            <div class="trusted-foot">
                <div class="trusted-desc">
                    <p>Imagine content that’s effortless to create yet impossible to ignore. We’ve stripped away the clutter—no more guesswork, endless edits, or bloated processes.</p>
                    <p>Just your raw ideas + our precision toolkit for turning them into audience magnets. This isn’t just convenience. It’s a new standard of impact: faster, smarter, and packed with creative firepower.</p>
                </div>
                <div class="trusted-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/trusted/image2.jpg'; ?>"></div>
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
