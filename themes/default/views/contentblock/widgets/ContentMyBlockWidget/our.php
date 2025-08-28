<?php if($block): ?>
    <div class="our">
        <div class="container">
            <div class="our-main">
                <div class="our-col">
                    <div class="our-desc"><?= $block->content; ?></div>
                    <div class="our-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/our/image.jpg'; ?>"></div>
                </div>
                <div class="our-col">
                    <div class="our-info">
                        <div class="our-info-text">
                            <div class="our-title title title--words"><?= $block->content2; ?></div>
                            <div class="our-descs">
                                <div class="our-desc"><?= $block->content3; ?></div>
                                <div class="our-desc"><?= $block->content4; ?></div>
                            </div>
                        </div>
                        <div class="our-info-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/our/image2.jpg'; ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
