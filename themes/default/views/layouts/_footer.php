<footer class="footer">
    <div class="container">
        <div class="footer-main">
            <div class="footer-main-col footer-main-menus">
                <div class="footer-menu">
                    <div class="footer-menu-title"><?= Yii::t('OtherModule.other', 'Content'); ?></div>
                    <?php if (Yii::app()->hasModule('menu')): ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'top-menu', 'name' => 'bottom-menu-1']); ?>
                    <?php endif; ?>
                </div>
                <div class="footer-menu">
                    <div class="footer-menu-title"><?= Yii::t('OtherModule.other', 'Company'); ?></div>
                    <?php if (Yii::app()->hasModule('menu')): ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'top-menu', 'name' => 'bottom-menu-2']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-main-col">
                <div class="footer-perms">
                    <div><a href="mailto:<?= Yii::app()->getModule('yupe')->email; ?>"><?= Yii::app()->getModule('yupe')->email; ?></a></div>
                    <div class="footer-perm">
                        <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'terms-and-conditions']); ?>"><?= Yii::t('OtherModule.other', 'Terms And Conditions'); ?></a> | <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'privacy-policy']); ?>"><?= Yii::t('OtherModule.other', 'Privacy Policy'); ?></a> | <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'cookie-policy']); ?>"><?= Yii::t('OtherModule.other', 'Cookie Policy'); ?></a>
                    </div>
                    <div class="footer-perm"><?= Yii::t('OtherModule.other', '© '); ?><?= date('Y') ?> EssayFlow. <?= Yii::t('OtherModule.other', 'All rights reserved'); ?>.</div>
                </div>
            </div>
            <div class="footer-main-col">
                <div class="footer-info">
                    <div class="footer-info-col">
                        <div class="footer-desc"><?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'footer', 'view' => 'footer']); ?></div>
                        <div class="footer-payment">
                            <img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/visa-white.svg'; ?>" width="70" height="70">
                            <img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/mastercard.svg'; ?>" width="70" height="70">
                        </div>
                    </div>
                    <div class="footer-info-col"></div>
                </div>
            </div>
        </div>
        <div class="footer-foot">
            <div class="footer-bg"><img src="<?= Yii::app()->getTheme()->getAssetsUrl() . '/images/screen/bg.jpg'; ?>"></div>
        </div>
    </div>
</footer>

