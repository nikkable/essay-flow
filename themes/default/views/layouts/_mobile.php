<div class="mobile js-mobile">
    <div class="mobile-main">
        <button class="btn mobile-close js-mobile-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.75 5.25L5.25 18.75" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.75 18.75L5.25 5.25" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div style="margin-bottom: 15px;">
            <?php if (Yii::app()->hasModule('menu')): ?>
                <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'mobile', 'name' => 'top-menu']); ?>
            <?php endif; ?>

            <?php if(Yii::app()->getUser()->getIsGuest()): ?>
                <ul class="mobile-menu">
                    <li><a href="<?= Yii::app()->createUrl('/user/account/login'); ?>"><?= Yii::t('OtherModule.other', 'Login'); ?></a></li>
                    <li><a href="<?= Yii::app()->createUrl('/user/account/registration'); ?>"><?= Yii::t('OtherModule.other', 'Get started'); ?></a></li>

                    <?php if(Yii::app()->getModule('yupe')->authorRegistration): ?>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/user/account/registrationAuthor'); ?>"><?= Yii::t('OtherModule.other', 'Am author'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>

            <?php if(!Yii::app()->getUser()->getIsGuest()): ?>
                <ul class="mobile-menu">
                    <li><a href="<?= Yii::app()->createUrl('/user/profile/profile'); ?>"><?= Yii::t('OtherModule.other', 'Profile'); ?></a></li>

                    <?php if(Yii::app()->user->checkAccess('author')): ?>
                        <li><a href="<?= Yii::app()->createUrl('/order/order/accumulations') ?>"><?= Yii::t("OtherModule.other", "My info"); ?></a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="lang-wrap">
            <div class="lang">
                <div class="lang-box js-lang-box">
                    <?php if (Yii::app()->hasModule('menu')) : ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'language-menu']); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="lang">
                <div class="lang-box js-lang-box">
                    <?php if (Yii::app()->hasModule('menu')) : ?>
                        <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'currency-menu']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>