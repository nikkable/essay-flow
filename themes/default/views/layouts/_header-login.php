<?php
Yii::import('application.modules.other.OtherModule');

$isFrontpage = false;

if (Yii::app()->controller->getId() == 'hp') {
    $isFrontpage = true;
}
?>

<header class="header header--auth">
    <div class="container">
        <div class="header-main">
            <a class="header-logo" href="/">
                <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/logo.svg') ?>
            </a>
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
        </div>
    </div>
</header>