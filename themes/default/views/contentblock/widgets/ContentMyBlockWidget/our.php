<?php if($block): ?>
    <div class="our">
        <div class="container">
            <div class="our-main">
                <div class="our-col">
                    <div class="our-desc">Our expert writers handle the hard work while you enjoy the results – fast, flawless, and tailored just for you.</div>
                    <div class="our-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/our/image.jpg'; ?>"></div>
                </div>
                <div class="our-col">
                    <div class="our-info">
                        <div class="our-info-text">
                            <div class="our-title title title--words"><span>Transform</span><span>your writing</span><span>stress</span><span>into success –</span><span>Essay-Flow</span><span>crafts</span><span>brilliance</span><span>from</span><span>your ideas</span><span>with</span><span>a single click.</span></div>
                            <div class="our-descs">
                                <div class="our-desc">Writing shouldn’t feel like a chore. With Perfect-Essay, it becomes an exciting journey from idea to excellence. Just share your vision with us, and our skilled writers will transform it into a compelling, well-researched masterpiece – all with the simplicity of a single click.</div>
                                <div class="our-desc">Revisions? We’ve got you covered until you’re thrilled with the result. No more stress, no more frustration – just outstanding writing that opens doors. Let’s turn your next project into an achievement worth celebrating!</div>
                            </div>
                        </div>
                        <div class="our-info-image"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/our/image2.jpg'; ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    <div class="started-info">
        <div class="started-title-top">
            <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/stars.svg') ?>
        </div>
        <div class="started-title title" data-aos="fade-up"><?= $block->content; ?></div>
        <div class="started-buts" data-aos="fade-up">
            <?php if(!Yii::app()->getUser()->isAuthenticated()): ?>
                <a href="<?= Yii::app()->createUrl('/user/account/registration'); ?>" class="btn btn-three">
                    <span><?= Yii::t("OtherModule.other", "Register"); ?></span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.3104 0.00012207C10.7484 3.79345 13.0198 7.01391 16.2252 8.38538L20 10.0001L16.2252 11.6149C13.0198 12.9863 10.7484 16.2068 10.3104 20.0001L8.70942 19.7702C9.13888 16.0515 11.0717 12.8042 13.8899 10.8988H0V9.10148H13.8899C11.0717 7.19608 9.13888 3.94871 8.70942 0.230047L10.3104 0.00012207Z" fill="white"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <div class="started-desc" data-aos="fade-up"><?= $block->content2; ?></div>
        <div class="started-login" data-aos="fade-up">
            <?= $block->content3; ?>
            <?php if(Yii::app()->getUser()->isAuthenticated()): ?>
                <a href="<?= Yii::app()->createUrl('order/user/index'); ?>" class="btn btn-primary">
                    <span><?= Yii::t("OtherModule.other", "Login"); ?></span>
                </a>
            <?php else: ?>
                <a href="<?= Yii::app()->createUrl('/user/account/login'); ?>" class="btn btn-primary">
                    <span><?= Yii::t("OtherModule.other", "Login"); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
    -->
<?php endif; ?>
