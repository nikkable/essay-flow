<?php if($block): ?>
    <div class="screen-head">
        <div class="container">
            <div class="screen-head-wrap">
                <div class="screen-text screen-text--1"><?= $block->content; ?><span class="label">Your profile</span><span class="value">Students</span><span class="value">Applicants</span><span class="value">Postgraduate students</span><span class="value">Researchers</span><span class="value">Teachers</span><span class="value">Bloggers</span><span class="value">Copywriters</span><span class="value">Marketers</span></div>
                <div class="screen-info">
                    <div class="screen-title">
                        <?= $block->content2; ?>
                        <span>Ideas</span>
                        <span class="icon icon--arrow-right">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.3104 0.00012207C10.7484 3.79345 13.0198 7.01391 16.2252 8.38538L20 10.0001L16.2252 11.6149C13.0198 12.9863 10.7484 16.2068 10.3104 20.0001L8.70942 19.7702C9.13888 16.0515 11.0717 12.8042 13.8899 10.8988H0V9.10148H13.8899C11.0717 7.19608 9.13888 3.94871 8.70942 0.230047L10.3104 0.00012207Z" fill="white"/>
                            </svg>
                        </span>
                        <span>Mastery</span>
                        <span class="text-gradient">Perfect Essays</span>
                    </div>
                    <div class="screen-desc"><?= $block->content3; ?>Every great essay begins with a spark. We refine it with expertise—crafting clear, compelling, and flawless work. No stress, no guesswork. Just excellence, delivered.</div>
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
                <div class="screen-text screen-text--2"><span class="label">Your benefits</span><span class="value">Productive</span><span class="value">Stylish</span><span class="value">Neat&fast</span><span class="value">Comfortable</span><span class="value">Convenient</span><span class="value">High-quality</span><span class="value">Reliable</span><span class="value">Professional</span></div>
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
