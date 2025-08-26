<?php foreach ($data->products as $product): ?>
    <?php
        $periodName = EntityHelper::getEntityNameByCodeAndLang('Periods', $product->product->period->code, Yii::app()->language);
        $subjectName = EntityHelper::getEntityNameByCodeAndLang('Subjects', $product->product->subject->code, Yii::app()->language);
        $languageName = EntityHelper::getEntityNameByCodeAndLang('Language', $product->product->language->code, Yii::app()->language);
    ?>
    <div class="order-list">
        <div class="order-list-info">
            <div class="order-list-info-head">
                <div class="order-list-info-number"><?= Yii::t("OtherModule.other", "Order"); ?>: #<?= $data->orderNumber; ?></div>
            </div>
            <div class="order-list-info-main">
                <div class="order-list-info-col">
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "Date"); ?>:</div>
                        <div class="value"><?= date('d.m.Y H:i', strtotime($data->date)); ?></div>
                    </div>
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "Status"); ?>:</div>
                        <div class="value"><?= Yii::t("OtherModule.other", $data->getStatusTitle()); ?></div>
                    </div>
                    <?php if($product->product->period): ?>
                        <div class="order-list-info-row">
                            <div class="label"><?= Yii::t("OtherModule.other", "Deadline"); ?>:</div>
                            <div class="value"><?= $periodName ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if($product->product->subject): ?>
                        <div class="order-list-info-row">
                            <div class="label"><?= Yii::t("OtherModule.other", "Subject"); ?>:</div>
                            <div class="value"><?= $subjectName ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if($product->product->word): ?>
                        <div class="order-list-info-row">
                            <div class="label"><?= Yii::t("OtherModule.other", "Pages"); ?>:</div>
                            <div class="value"><?= $product->product->word->name ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="order-list-info-col">
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "Language"); ?>:</div>
                        <div class="value"><?= $languageName; ?></div>
                    </div>
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "Comment"); ?>:</div>
                        <div class="value"><?= $data->comment; ?></div>
                    </div>
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "File"); ?>:</div>
                        <div class="value">
                            <?php if($data->getFilePath()): ?>
                                <a href="<?= $data->getFilePath(); ?>"><?= Yii::t("OtherModule.other", "Download"); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "Payment"); ?>:</div>
                        <div class="value <?= $data->isPaid() ? 'color-green' : 'color-red'; ?>"><?= $data->getPaidStatus(); ?></div>
                    </div>
                    <div class="order-list-info-row order-list-info-row--price">
                        <div class="label"><?= Yii::t("OtherModule.other", "Total price"); ?></div>
                        <div class="value"><?= $data->getTotalPriceCurrencyFormat(); ?></div>
                    </div>
                    <div class="order-list-info-row">
                        <div class="label"><?= Yii::t("OtherModule.other", "Tax"); ?></div>
                        <div class="value"><?= $data->getTotalTaxFormat(); ?></div>
                    </div>
                </div>
            </div>

            <div class="order-list-info-foot">
                <?php if(Yii::app()->user->checkAccess('author')): ?>
                    <?php if(in_array($data->status_id, [OrderStatus::STATUS_NEW])): ?>
                        <a href="<?= Yii::app()->createUrl('order/order/job', ['slug' => $data->url]) ?>" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Accept order"); ?></a>
                    <?php endif; ?>

                    <?php if(in_array($data->status_id, [OrderStatus::STATUS_CONFIRMED_BY_PLATFORM])): ?>
                        <a href="<?= Yii::app()->createUrl('order/order/jobDone', ['slug' => $data->url]) ?>" class="btn btn-primary js-order-completed"><?= Yii::t("OtherModule.other", "Order completed"); ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(!$data->isPaid()): ?>
                        <a href="<?= Yii::app()->createUrl('/order/order/view', ['url' => $data->url]) ?>" class="btn btn-primary btn-small"><?= Yii::t("OtherModule.other", "Pay now"); ?></a>
                    <?php endif; ?>
                    <a href="<?= Yii::app()->createUrl('/order/order/view', ['url' => $data->url]) ?>" class="btn btn-secondary btn-small"><?= Yii::t("OtherModule.other", "Order details"); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>