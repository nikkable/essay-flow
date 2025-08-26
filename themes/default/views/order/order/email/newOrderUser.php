<?php
    Yii::import('application.modules.other.OtherModule');
?>
<html>
<head>
</head>
<body>
<h1 style="font-weight:normal;">
    <?= Yii::t("OtherModule.other", "Your order for the amount {n} on {site}", [
            '{n}' => $order->getTotalPriceCurrencyFormat(),
            '{site}' => Yii::app()->getModule('yupe')->siteName
    ]); ?>
</h1>
<table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
    <?php foreach ((array)$order->products as $position): ?>
        <tr>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Type"); ?></td>
            <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?= CHtml::encode($position->product->name); ?>
            </td>
        </tr>
        <tr>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Info"); ?></td>
            <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?php if($position->product->period): ?>
                    <p><?= Yii::t("OtherModule.other", "Period"); ?>: <?= $position->product->period->name; ?></p>
                <?php endif; ?>
                <?php if($position->product->subject): ?>
                    <p><?= Yii::t("OtherModule.other", "Subject"); ?>: <?= $position->product->subject->name; ?></p>
                <?php endif; ?>
                <?php if($position->product->language): ?>
                    <p><?= Yii::t("OtherModule.other", "Language"); ?>: <?= $position->product->language->name; ?></p>
                <?php endif; ?>
                <?php if($position->product->word): ?>
                    <p><?= Yii::t("OtherModule.other", "Pages"); ?>: <?= $position->product->word->name; ?></p>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;">
            <?= Yii::t("OtherModule.other", "Payment"); ?>
        </td>
        <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
            <?= $order->getPaidStatus(); ?>
        </td>
    </tr>
    <tr>
        <td style="padding:6px; width:170px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Status"); ?></td>
        <td style="padding:6px; width:330px; background-color:#ffffff; border:1px solid #e0e0e0;">
            <?= Yii::t("OtherModule.other", $order->getStatusTitle()); ?>
        </td>
    </tr>
    <?php if ($order->name): ?>
        <tr>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Name"); ?></td>
            <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?= CHtml::encode($order->name); ?>
            </td>
        </tr>
    <?php endif; ?>
    <?php if ($order->email): ?>
        <tr>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Email"); ?></td>
            <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?= CHtml::encode($order->email); ?>
            </td>
        </tr>
    <?php endif; ?>
    <?php if ($order->phone): ?>
        <tr>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Phone"); ?></td>
            <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?= CHtml::encode($order->phone); ?>
            </td>
        </tr>
    <?php endif; ?>
    <?php if ($order->comment): ?>
        <tr>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;"><?= Yii::t("OtherModule.other", "Comment"); ?></td>
            <td style="padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;">
                <?= nl2br(CHtml::encode($order->comment)); ?>
            </td>
        </tr>
    <?php endif; ?>
</table>

<h1 style="font-weight:normal;"><?= Yii::t("OtherModule.other", "The buyer ordered"); ?>:</h1>

<table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">

    <?php foreach ($order->products as $orderProduct): ?>
        <?php $productUrl = ProductHelper::getUrl($orderProduct->product, true) ?>
        <tr>
            <td align="center" style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;"></td>
            <td style="padding:6px; width:250px; padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;">
                <?= $orderProduct->product_name; ?>
            </td>
            <td align=right style="padding:6px; text-align:right; width:150px; background-color:#ffffff; border:1px solid #e0e0e0;"></td>
        </tr>
    <?php endforeach; ?>

    <?php if ($order->hasCoupons()): ?>
        <tr>
            <td style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;"></td>
            <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;">
                <?= Yii::t("OtherModule.other", "Coupon"); ?> <?= CHtml::encode(implode(', ', $order->getCouponsCodes())); ?>
            </td>
            <td align=right
                style="padding:6px; text-align:right; width:170px; background-color:#ffffff; border:1px solid #e0e0e0;">
                &minus;<?= $order->coupon_discount; ?>&nbsp;<?= Yii::app()->controller->currency ?>
            </td>
        </tr>
    <?php endif; ?>

    <tr>
        <td style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;"></td>
        <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;font-weight:bold;">
            <?= Yii::t("OtherModule.other", "Tax"); ?>
        </td>
        <td align="right" style="padding:6px; text-align:right; width:170px; background-color:#ffffff; border:1px solid #e0e0e0;font-weight:bold;">
            <?= $order->getTotalTaxFormat() ?>
        </td>
    </tr>

    <tr>
        <td style="padding:6px; width:100px; padding:6px; background-color:#ffffff; border:1px solid #e0e0e0;"></td>
        <td style="padding:6px; background-color:#f0f0f0; border:1px solid #e0e0e0;font-weight:bold;"><?= Yii::t("OtherModule.other", "Total"); ?></td>
        <td align="right"
            style="padding:6px; text-align:right; width:170px; background-color:#ffffff; border:1px solid #e0e0e0;font-weight:bold;">
            <?= $order->getTotalPriceCurrencyFormat(); ?>
        </td>
    </tr>
</table>

<br/>
<?= Yii::t("OtherModule.other", "You can always check the order status by following the link"); ?>:<br>
<?= CHtml::link(
    Yii::t("OtherModule.other", "Order link"),
    Yii::app()->createAbsoluteUrl('/order/order/view', ['url' => $order->url])
); ?>
<br/>

</body>
</html>
