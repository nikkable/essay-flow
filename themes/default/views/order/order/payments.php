<?php
Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('UserModule.user', 'Payments');
$this->breadcrumbs = [Yii::t('UserModule.user', 'Payments')];
?>

<div class="container" style="padding-bottom: 50px;">
    <h1><?= Yii::t('OtherModule.other', 'Payments'); ?></h1>

    <div class="m-b-5">
        <a href="<?= Yii::app()->createUrl('/user/profile/profile') ?>" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Profile"); ?></a>

        <?php if(Yii::app()->user->checkAccess('author')): ?>
            <a href="<?= Yii::app()->createUrl('/order/order/payments') ?>" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Payments"); ?></a>
            <a href="<?= Yii::app()->createUrl('/user/profile/verify') ?>" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Verify"); ?></a>
        <?php endif; ?>
    </div>

    <div class="order-lists">
        <?php foreach($data as $item): ?>
            <div class="order-list">
                <div class="order-list-info">
                    <div class="order-list-info-head">
                        <div class="order-list-info-number"><?= Yii::t("OtherModule.other", "Date"); ?>: <?= date('d.m.Y H:i', strtotime($item->created_at)); ?></div>
                    </div>
                    <div class="order-list-info-main">
                        <div class="order-list-info-col">
                            <div class="order-list-info-row">
                                <div class="label"><?= Yii::t("OtherModule.other", "Card name"); ?>:</div>
                                <div class="value"><?= $item->cart_name; ?></div>
                            </div>
                            <div class="order-list-info-row">
                                <div class="label"><?= Yii::t("OtherModule.other", "Card number"); ?>:</div>
                                <div class="value"><?= $item->cart_number; ?></div>
                            </div>
                            <div class="order-list-info-row">
                                <div class="label"><?= Yii::t("OtherModule.other", "Currency"); ?>:</div>
                                <div class="value"><?= $item->currency; ?></div>
                            </div>
                        </div>
                        <div class="order-list-info-col">
                            <div class="order-list-info-row">
                                <div class="label"><?= Yii::t("OtherModule.other", "Sum"); ?>:</div>
                                <div class="value"><?= $item->hold > 0 ? $item->hold : $item->paid; ?></div>
                            </div>
                            <div class="order-list-info-row">
                                <div class="label"><?= Yii::t("OtherModule.other", "Expiry"); ?>:</div>
                                <div class="value"><?= 'Month: ' . $item->expiry_month . ' Year: ' . $item->expiry_year . ''; ?></div>
                            </div>
                            <div class="order-list-info-row">
                                <div class="label"><?= Yii::t("OtherModule.other", "Status"); ?>:</div>
                                <div class="value"><?= $item->hold > 0 ? '<span style="background: yellow;padding: 2px 5px;border-radius: 4px;color: black;">Waiting</span>' : '<span style="background: green;color: white;padding: 2px 5px;border-radius: 4px;">Paid</span>'; ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="order-list-info-foot">

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <?php
//        echo "<pre>";
//        print_r($model);
//        die;
    ?>
</div>


