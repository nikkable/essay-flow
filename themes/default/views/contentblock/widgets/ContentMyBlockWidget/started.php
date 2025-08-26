<?php if($block): ?>
    <div class="started">
        <div class="bg">
            <div class="container">
                <div class="started-main">
                    <div class="started-info">
                        <div class="started-title"><?= $block->content; ?></div>
                        <div class="started-buts">
                            <?php if(!Yii::app()->getUser()->isAuthenticated()): ?>
                                <a href="<?= Yii::app()->createUrl('/user/account/registration'); ?>" class="btn btn-three">
                                    <span><?= Yii::t("OtherModule.other", "Register"); ?></span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.3104 0.00012207C10.7484 3.79345 13.0198 7.01391 16.2252 8.38538L20 10.0001L16.2252 11.6149C13.0198 12.9863 10.7484 16.2068 10.3104 20.0001L8.70942 19.7702C9.13888 16.0515 11.0717 12.8042 13.8899 10.8988H0V9.10148H13.8899C11.0717 7.19608 9.13888 3.94871 8.70942 0.230047L10.3104 0.00012207Z" fill="white"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="started-desc desc"><?= $block->content2; ?></div>
                        <div class="started-login desc"><?= $block->content3; ?></div>
                        <div class="started-buts">
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
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
