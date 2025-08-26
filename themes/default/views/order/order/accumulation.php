<?php
Yii::import('application.modules.other.OtherModule');
Yii::import('application.modules.currency.models.Currency');

$this->title = Yii::t('OtherModule.other', 'My earnings');
?>

<div class="container" style="padding-bottom: 50px;">
    <div class="d-flex flex-wrap flex-justify-content-between flex-align-items-center flex-gap-3 m-b-5 m-t-5">
        <h1><?= Yii::t("OtherModule.other", "Earnings history"); ?></h1>
    </div>

    <div class="order-view">
        <div class="order-view-info">
            <?php $this->widget('yupe\widgets\YFlashMessages'); ?>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Balance"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har">
                        <div class="label"><?= Yii::t("OtherModule.other", "Total"); ?>:</div>
                        <div class="value"><?= $model['priceTotal'] ?> <?= Yii::app()->controller->currency ?></div>
                    </div>
                    <div class="order-view-har">
                        <div class="label"><?= Yii::t("OtherModule.other", "Platform commission"); ?>:</div>
                        <div class="value"><?= $model['commission'] ?> <?= Yii::app()->controller->currency ?></div>
                    </div>
                    <div class="order-view-har">
                        <div class="label"><?= Yii::t("OtherModule.other", "Paid"); ?>:</div>
                        <div class="value"><?= $model['pricePaid'] ?> <?= Yii::app()->controller->currency ?></div>
                    </div>
                    <div class="order-view-har">
                        <div class="label"><?= Yii::t("OtherModule.other", "Reserved"); ?>:</div>
                        <div class="value"><?= $model['priceHold'] ?> <?= Yii::app()->controller->currency ?></div>
                    </div>
                    <div class="order-view-har">
                        <div class="label"><?= Yii::t("OtherModule.other", "Available for withdrawal"); ?>:</div>
                        <div class="value"><?= $model['available'] ?> <?= Yii::app()->controller->currency ?></div>
                    </div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Orders in progress"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= $model['ordersInWork'] ?></div>
                </div>
            </div>
            <div class="order-view-row">
                <div class="order-view-col"><?= Yii::t("OtherModule.other", "Orders completed"); ?></div>
                <div class="order-view-col">
                    <div class="order-view-har"><?= $model['ordersFinished'] ?></div>
                </div>
            </div>
        </div>
        <div class="order-view-side"></div>

        <p>
            <a href="#" class="btn btn-primary" data-modal data-modal-id="modal-author-payments"><?= Yii::t("OtherModule.other", "Withdraw funds"); ?></a>
        </p>
    </div>
</div>

<div class="modal modal-accumulations js-modal-author-payments <?= count($formModel->getErrors()) > 0 ? 'modal--show' : ''; ?>" id="modal-author-payments">
    <div class="modal-dialog">
        <button class="btn modal-close js-modal-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.75 5.25L5.25 18.75" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.75 18.75L5.25 5.25" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div class="modal-head">
            <div class="modal-title title"><?= Yii::t("OtherModule.other", "Withdraw funds"); ?></div>
        </div>
        <div class="modal-main">
            <?php
                $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    [
                        'id' => 'author-payments-form',
                        'action' => ['/order/order/accumulations'],
                        'type' => 'vertical',
                        'htmlOptions' => [
                            'class' => 'well',
                        ]
                    ]
                );
            ?>
                <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                <?= $form->errorSummary($formModel); ?>

                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Cardholder name'); ?> *</label>
                    <?= $form->textField($formModel, 'cart_name', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Cardholder name') ]); ?>
                </div>
                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Cart number'); ?> *</label>
                    <?= $form->textField($formModel, 'cart_number', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Cart number') ]); ?>
                </div>
                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Expiry month'); ?> *</label>
                    <?= $form->textField($formModel, 'expiry_month', [
                        'class' => 'field-text',
                        'placeholder' => Yii::t('OtherModule.other', 'Expiry month'),
                        'maxlength' => 2
                    ]); ?>
                </div>
                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Expiry year'); ?> *</label>
                    <?= $form->textField($formModel, 'expiry_year', [
                        'class' => 'field-text',
                        'placeholder' => Yii::t('OtherModule.other', 'Expiry year'),
                        'maxlength' => 2
                    ]); ?>
                </div>
                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Currency'); ?> *</label>
                    <div class="field-selected-wrap">
                        <select class="field-selected" name="<?= get_class($formModel) ?>[currency]" id="<?= get_class($formModel) ?>_currency">
                            <?php foreach (Currency::getCurrencyAll(true) as $item): ?>
                                <option value="<?= $item['label']; ?>"><?= $item['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><?= Yii::t('OtherModule.other', 'Amount'); ?> *</label>
                    <?= $form->numberField($formModel, 'sum', [ 'class' => 'field-text', 'placeholder' => Yii::t('OtherModule.other', 'Amount') ]); ?>
                </div>

                <p>
                    <button type="submit" class="btn btn-primary"><?= Yii::t('OtherModule.other', 'Withdraw funds'); ?></button>
                </p>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>


