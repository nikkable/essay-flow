<?php
Yii::import('application.modules.other.OtherModule');

$isFrontpage = false;

if (Yii::app()->controller->getId() == 'hp') {
    $isFrontpage = true;
}
?>

<header class="header <?= $isFrontpage ? 'header--home' : ''; ?>">
    <div class="container">
        <div class="header-main">
            <a class="header-logo" href="/">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/logo.svg') ?>
            </a>
            <div class="header-menu">
                <?php if (Yii::app()->hasModule('menu')): ?>
                    <?php $this->widget('application.modules.menu.widgets.MenuWidget', ['view' => 'top-menu', 'name' => 'top-menu']); ?>
                <?php endif; ?>
            </div>
            <div class="header-langs">
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
            <div class="header-buttons">
                <?php if(!Yii::app()->getUser()->getIsGuest()): ?>
                    <a href="<?= Yii::app()->createUrl('/user/profile/profile'); ?>" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Profile'); ?></a>
                <?php endif; ?>

                <?php if(Yii::app()->getUser()->getIsGuest()): ?>
                    <a href="<?= Yii::app()->createUrl('/user/account/login'); ?>" class="btn btn-secondary"><?= Yii::t('OtherModule.other', 'Login'); ?></a>
                    <a href="<?= Yii::app()->createUrl('/user/account/registration'); ?>" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Get started'); ?></a>

                    <?php if(Yii::app()->getModule('yupe')->authorRegistration): ?>
                        <a href="<?= Yii::app()->createUrl('/user/account/registrationAuthor'); ?>" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Am author'); ?></a>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Yii::app()->user->checkAccess('author')): ?>
                    <a href="<?= Yii::app()->createUrl('/order/order/accumulations') ?>" class="btn btn-primary"><?= Yii::t("OtherModule.other", "My info"); ?></a>
                <?php endif; ?>
            </div>

            <button class="btn header-app js-header-app">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/app.svg') ?>
            </button>
        </div>
    </div>
</header>