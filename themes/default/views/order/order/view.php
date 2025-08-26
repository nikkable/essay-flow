<?php
/* @var $model Order */
$mainAssets = Yii::app()->getTheme()->getAssetsUrl();
Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/order-frontend.css');
Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');

Yii::import('application.modules.other.OtherModule');

$this->title = Yii::t('OtherModule.other', 'My order');
?>

<div class="container m-t-5 m-b-5">
    <a href="/" class="btn btn-prev">
        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M26.9167 17L7.08341 17" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17 26.916L7.08333 16.9993L17 7.08268" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span><?= Yii::t('OtherModule.other', 'Back'); ?></span>
    </a>
    <div class="d-flex flex-wrap flex-justify-content-between flex-align-items-center flex-gap-3 m-b-3">
        <h1><?= Yii::t("OtherModule.other", "Order"); ?> #<?= $model->orderNumber; ?></h1>
    </div>

    <div class="order-view">
        <div class="order-view-info">
            <div class="order-view-label"><?= Yii::t("OtherModule.other", "Info"); ?></div>
            <?php foreach ((array)$model->products as $position): ?>
                <?php
                    $periodName = EntityHelper::getEntityNameByCodeAndLang('Periods', $position->product->period->code, Yii::app()->language);
                    $subjectName = EntityHelper::getEntityNameByCodeAndLang('Subjects', $position->product->subject->code, Yii::app()->language);
                    $languageName = EntityHelper::getEntityNameByCodeAndLang('Language', $position->product->language->code, Yii::app()->language);
                ?>
                <div class="order-view-row">
                    <div class="order-view-col"><?= Yii::t("OtherModule.other", "Type"); ?></div>
                    <div class="order-view-col">
                        <div class="order-view-har"><?= CHtml::encode($position->product->name); ?></div>
                    </div>
                </div>
                <?php if($position->product->period): ?>
                    <div class="order-view-row">
                        <div class="order-view-col"><?= Yii::t("OtherModule.other", "Deadline"); ?></div>
                        <div class="order-view-col">
                            <div class="order-view-har"><?= $periodName; ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($position->product->subject): ?>
                    <div class="order-view-row">
                        <div class="order-view-col"><?= Yii::t("OtherModule.other", "Subject"); ?></div>
                        <div class="order-view-col">
                            <div class="order-view-har"><?= $subjectName; ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($position->product->word): ?>
                    <div class="order-view-row">
                        <div class="order-view-col"><?= Yii::t("OtherModule.other", "Pages"); ?></div>
                        <div class="order-view-col">
                            <div class="order-view-har"><?= $position->product->word->name; ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($position->product->language): ?>
                    <div class="order-view-row">
                        <div class="order-view-col"><?= Yii::t("OtherModule.other", "Language"); ?></div>
                        <div class="order-view-col">
                            <div class="order-view-har"><?= $languageName; ?></div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Payment"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har <?= $model->isPaid() ? 'color-green' : 'color-red'; ?>"><?= $model->getPaidStatus(); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Status"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= Yii::t("OtherModule.other", $model->getStatusTitle()); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Promocode"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har">
                        <?php if(count($model->getCouponsCodes()) > 0): ?>
                            <?php foreach ($model->getCouponsCodes() as $code): ?>
                                <?= CHtml::encode($code); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Discount"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= $model->coupon_discount; ?> <?= Yii::app()->controller->currency; ?></div>
                </div>
            </div>
            <br>

            <div class="order-view-label"><?= Yii::t("OtherModule.other", "Order details"); ?></div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Created"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= $model->date; ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Client"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= CHtml::encode($model->name); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Phone"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= CHtml::encode($model->phone); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Email"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= CHtml::encode($model->email); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Comment"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= CHtml::encode($model->comment); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "File"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har">
                        <?php if($model->getFilePath()): ?>
                            <a href="<?= $model->getFilePath(); ?>"><?= Yii::t("OtherModule.other", "Download"); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Tax"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= $model->getTotalTaxFormat(); ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Total"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= $model->getTotalPriceCurrencyFormat() ?></div>
                </div>
            </div>
        </div>
        <div class="order-view-side">
            <div class="order-view-side-title"><?= Yii::t("OtherModule.other", "Total"); ?></div>
            <div class="order-view-side-row">
                <div class="label"><?= Yii::t("OtherModule.other", "Total price"); ?></div>
                <div class="value"><?= $model->getTotalPriceCurrencyFormat() ?></div>
            </div>
            <div class="order-view-side-buts">
                <?php if (!$model->isPaid() && !$model->isPaymentMethodSelected() && !empty($model->delivery) && $model->delivery->hasPaymentMethods()): ?>
                    <div class="hidden" id="payment-methods">
                        <?php foreach ((array)$model->delivery->paymentMethods as $payment): ?>
                            <div class="payment-method">
                                <div class="checkbox">
                                    <input class="payment-method-radio" type="radio" name="payment_method_id"
                                           value="<?= $payment->id; ?>" checked=""
                                           id="payment-<?= $payment->id; ?>">
                                    <label for="payment-<?= $payment->id; ?>"><?= CHtml::encode($payment->name); ?></label>
                                </div>
                                <div class="payment-form">
                                    <?= $payment->getPaymentForm($model); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if($model->getTotalPrice() > 0): ?>
                        <button type="submit" class="btn btn-primary" id="start-payment">
                            <?= Yii::t("OtherModule.other", "Pay now"); ?>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal js-modal-success">
    <div class="modal-dialog">
        <button class="btn modal-close js-modal-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.75 5.25L5.25 18.75" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.75 18.75L5.25 5.25" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div class="modal-head">
            <div class="modal-title title"><?= Yii::t("OtherModule.other", "Status"); ?></div>
        </div>
        <div class="modal-main">
            <p><?= Yii::t("OtherModule.other", "Your order has been successfully paid"); ?></p>
            <br>
            <a href="/store/account" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Go to orders"); ?></a>
        </div>
    </div>
</div>

<div class="modal js-modal-error">
    <div class="modal-dialog">
        <button class="btn modal-close js-modal-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.75 5.25L5.25 18.75" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.75 18.75L5.25 5.25" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div class="modal-head">
            <div class="modal-title title"><?= Yii::t("OtherModule.other", "Status"); ?></div>
        </div>
        <div class="modal-main">
            <p class="color-red"><?= Yii::t("OtherModule.other", "An error occured, please try again"); ?>.</p>
            <br>
            <a href="#" class="btn btn-primary js-repeat-payment"><?= Yii::t("OtherModule.other", "Repeat the payment"); ?></a>
            <a href="/" class="btn btn-secondary"><?= Yii::t("OtherModule.other", "Home"); ?></a>
        </div>
    </div>
</div>

<script>
    const params = (new URL(document.location)).searchParams;

    if(params.get('success')) {
        const modal = document.querySelector('.js-modal-success')

        if(modal) {
            modal.classList.add('modal--show')
        }
    }

    if(params.get('error')) {
        const modal = document.querySelector('.js-modal-error')

        if(modal) {
            modal.classList.add('modal--show')
        }
    }

    const repeatPayment = document.querySelector('.js-repeat-payment')

    if(repeatPayment) {
        repeatPayment.addEventListener('click', event => {
            event.preventDefault()
            const payment = document.querySelector('#start-payment')
            payment.click()
        })
    }
</script>

