<?php
    Yii::import('application.modules.other.OtherModule');
?>

<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
<head>
    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_START);?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
    <!--
    <meta http-equiv="Content-Language" content="ru-RU" />
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title><?= $this->title;?></title>
    <meta name="description" content="<?= $this->description;?>" />
    <meta name="keywords" content="<?= $this->keywords;?>" />

    <?php if (($_SERVER['REQUEST_URI']) == '/back.php')
        echo "<meta name='robots' content='noindex, nofollow'/>"
    ?>

    <?php if ($this->canonical): ?>
        <link rel="canonical" href="<?= $this->canonical ?>" />
    <?php endif; ?>

    <?php
    $yupeAssets = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.yupe.views.assets'));

    Yii::app()->getClientScript()->registerLinkTag('preload stylesheet', 'text/css', $this->mainAssets . '/css/style.min.css?clear1');
//    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/slick.min.js', CClientScript::POS_END);
//    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/aos.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/aos.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/gsap.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/SplitText.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/ScrollTrigger.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/main.min.js?clear2', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerCssFile($yupeAssets . '/css/flags.css');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/bootstrap-notify.js');
    Yii::app()->getClientScript()->registerScriptFile($this->mainAssets . '/js/jquery.li-translit.js');
    Yii::app()->getClientScript()->registerScriptFile('https://www.google.com/recaptcha/api.js', CClientScript::POS_END);
    ?>
    <script type="text/javascript">
        var yupeTokenName = '<?= Yii::app()->getRequest()->csrfTokenName;?>';
        var yupeToken = '<?= Yii::app()->getRequest()->getCsrfToken();?>';
        var cookieConsentMessageText = "<?= Yii::t('OtherModule.other', "Your consent to cookie data processing is required to enable this section's functionality."); ?>";
        var cookieConsentBtnText = "<?= Yii::t('OtherModule.other', 'View consent'); ?>";
    </script>

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::HEAD_END);?>
</head>

<body>

<?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_START);?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3QKN637K93"></script>
<script>
    // window.dataLayer = window.dataLayer || [];
    // function gtag(){dataLayer.push(arguments);}
    // gtag('js', new Date());
    //
    // gtag('config', 'G-3QKN637K93');
</script>

<div class="wrapper">
    <?php if(Yii::app()->controller->id === 'account' && (Yii::app()->controller->getAction()->id === 'login' ||
            Yii::app()->controller->getAction()->id === 'registration') ||
        Yii::app()->controller->getAction()->id === 'recovery' ||
        Yii::app()->controller->getAction()->id === 'registrationAuthor'):
        ?>
        <?= $content; ?>
    <?php else: ?>
        <?= $this->decodeWidgets($this->renderPartial('//layouts/_header')); ?>
        <?= $this->decodeWidgets($this->renderPartial('//layouts/_mobile')); ?>

        <?= $content; ?>

        <?= $this->decodeWidgets($this->renderPartial('//layouts/_footer')); ?>
    <?php endif; ?>
</div>

<div class="cookie js-cookie">
    <div class="cookie-main">
        <p>
            <?= Yii::t('OtherModule.other', 'We use'); ?> <a class="cookie-link" href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'cookie-policy']); ?>" target="_blank" aria-label="cookie" rel="noreferrer"><?= Yii::t('OtherModule.other', 'cookies'); ?></a>
        </p>
        <p><?= Yii::t('OtherModule.other', 'For the proper functioning of this website (including login, registration, and order management), the use of cookies is required.'); ?></p>
        <p>
            <ul>
                <li><?= Yii::t('OtherModule.other', 'By clicking "Accept all", you consent to the use of cookies for both essential website operations and visitor analytics.'); ?></li>
                <li><?= Yii::t('OtherModule.other', 'Selecting "Only necessary" will enable only strictly required cookies for core functionality.'); ?></li>
                <li><?= Yii::t('OtherModule.other', 'If you choose "Decline", key features of the website may become unavailable.'); ?></li>
            </ul>
        </p>
        <div class="cookie-buts">
          <button type="button" class="cookie-btn btn btn-small btn-primary js-cookie-accept-all" title=""><?= Yii::t('OtherModule.other', 'Accept all'); ?></button>
          <button type="button" class="cookie-btn btn btn-small btn-primary js-cookie-necessary-only" title=""><?= Yii::t('OtherModule.other', 'Only necessary'); ?></button>
          <button type="button" class="cookie-btn btn btn-small btn-secondary js-cookie-reject" title=""><?= Yii::t('OtherModule.other', 'Decline'); ?></button>
        </div>
    </div>
</div>

<?php
Yii::app()->getClientScript()->registerScript(
    'gsap',
    "
        gsap.registerPlugin(SplitText);
        gsap.registerPlugin(ScrollTrigger);
        
        gsap.set('.js-screen-title', { opacity: 1 });
    
        let split = SplitText.create('.js-screen-title', { type: 'chars' });
        gsap.from(split.chars, {
            y: 20,
            autoAlpha: 0,
            stagger: 0.05
        });
        
        let delSections = document.querySelectorAll('.js-image');
        
        delSections.forEach(section => {
  
            let imageAnim = gsap.to(section, {
                y: '-20vh',
                ease: 'none',
                paused: true
            });
  
            let progressTo = gsap.quickTo(imageAnim, 'progress', {ease: 'power3', duration: parseFloat(section.dataset.scrub) || 0.1});
  
            gsap.to(section.querySelector('.js-image-container'), {
                y: '20vh',
                ease: 'none',
                scrollTrigger: {
                    scrub: true,
                    trigger: section,
                    start: 'top bottom',
                    end: 'bottom top',
                    onUpdate: self => progressTo(self.progress)
                }
            });

        });
    "
);
?>

<style>
    .js-screen-title {
        opacity: 0;
    }
</style>

<?php \yupe\components\TemplateEvent::fire(DefautThemeEvents::BODY_END);?>

</body>
</html>
