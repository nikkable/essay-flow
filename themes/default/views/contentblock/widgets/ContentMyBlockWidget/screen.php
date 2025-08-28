<?php if($block): ?>
    <div class="screen-head">
        <div class="container">
            <div class="screen-head-wrap">
                <div class="screen-text screen-text--1"><?= $block->content; ?></div>
                <div class="screen-info">
                    <div class="screen-title">
                        <?= $block->content2; ?>
                    </div>
                    <div class="screen-desc"><?= $block->content3; ?></div>
                    <div class="screen-buts">
                        <?php if(!Yii::app()->getUser()->isAuthenticated()): ?>
                            <div class="screen--buts"><a class="btn btn-gradient" href="<?= Yii::app()->createUrl('/user/account/registration'); ?>" data-aos="fade-left"><?= Yii::t("OtherModule.other", "Start Now"); ?></a></div>
                        <?php else: ?>
                            <?php if(!Yii::app()->user->checkAccess('author')): ?>
                                <div class="screen--buts" data-aos="fade-left" data-aos-delay="100">
                                    <a class="btn btn-gradient" href="<?= Yii::app()->createUrl('/cart/cart/index'); ?>" ><?= Yii::t("OtherModule.other", "Calculate Now"); ?></a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="screen-text screen-text--2"></div>
            </div>
        </div>
        <div class="screen-info-bg"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/screen/bg.jpg'; ?>"></div>
    </div>
    <div class="screen-main">
        <div class="container">
            <div class="screen-image">
                <div class="screen-image-bg"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/screen/image.jpg'; ?>"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
