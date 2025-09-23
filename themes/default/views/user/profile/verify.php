<?php
Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('UserModule.user', 'User profile');
$this->breadcrumbs = [Yii::t('UserModule.user', 'User profile')];
?>

<div class="container m-t-5 m-b-5">
    <h1><?= Yii::t('OtherModule.other', 'Profile'); ?></h1>

    <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

    <div class="m-b-5">
        <a href="<?= Yii::app()->createUrl('/user/profile/profile') ?>" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Profile"); ?></a>

        <?php if(Yii::app()->user->checkAccess('author')): ?>
            <a href="<?= Yii::app()->createUrl('/order/order/payments') ?>" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Payments"); ?></a>
            <a href="<?= Yii::app()->createUrl('/user/profile/verify') ?>" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Verify"); ?></a>
        <?php endif; ?>
    </div>

    <?php if($user->author_verification_status === null || $user->author_verification_status == USER::AUTHOR_VERIFICATION_REJECTED): ?>
        <p>To start accepting orders, you’ll need to pass verification.</p>
        <p>
            Fill in all fields on your Profile page, and the Verify button will appear here. To make the process faster, add your updated CV and professional link and make sure all details are accurate.
        </p>

        <!--
            <p>
                <?= Yii::t('OtherModule.other', 'To accept and fulfill orders, verification is a mandatory requirement. To do this, you need to fully complete all fields in your profile form. After successfully filling in all the required data, a button to initiate the verification process will become available on the current page.'); ?>
            </p>
        -->

        <div class="m-t-4">
            <?php if($user->isVerifyAuthorEnabled()): ?>
                <?php if($user->author_verification_status == USER::AUTHOR_VERIFICATION_REJECTED): ?>
                    <a href="<?= Yii::app()->createUrl('/user/profile/verifySend'); ?>" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Verify again'); ?></a>
                <?php else: ?>
                    <a href="<?= Yii::app()->createUrl('/user/profile/verifySend'); ?>" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Verify'); ?></a>
                <?php endif; ?>
            <?php else: ?>
                <p class="color-red"><?= Yii::t('OtherModule.other', 'Not all fields in your profile are filled in, so verification is unavailable.'); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if($user->author_verification_status !== null && (int)$user->author_verification_status === USER::AUTHOR_VERIFICATION_PENDING): ?>
        <p><?= Yii::t('OtherModule.other', 'Verification request sent.'); ?></p>
    <?php endif; ?>

    <?php if($user->author_verification_status == USER::AUTHOR_VERIFICATION_VERIFIED): ?>
        <p class="color-green"><?= Yii::t('OtherModule.other', 'Verified'); ?></p>
    <?php endif; ?>
</div>


