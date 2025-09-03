<?php
/* @var $this CartController */
/* @var $positions Product[] */
/* @var $order Order */
/* @var $coupons Coupon[] */

Yii::import('application.modules.rackcalc.models.Periods');
Yii::import('application.modules.rackcalc.models.Subjects');
Yii::import('application.modules.rackcalc.models.Words');
Yii::import('application.modules.other.OtherModule');

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

Yii::app()->getClientScript()->registerScriptFile($mainAssets . '/js/store.js');
//Yii::app()->getClientScript()->registerCssFile($mainAssets . '/css/cart-frontend.css');

$this->title = Yii::t('OtherModule.other', 'Place new order');
?>


<script type="text/javascript">
    var yupeCartDeleteProductUrl = '<?= Yii::app()->createUrl('/cart/cart/delete/')?>';
    var yupeCartUpdateUrl = '<?= Yii::app()->createUrl('/cart/cart/update/')?>';
    var yupeCartWidgetUrl = '<?= Yii::app()->createUrl('/cart/cart/widget/')?>';
    var yupeCartEmptyMessage = '';
</script>

<div class="container m-t-5">
    <div class="cart">
        <div class="cart-head">
            <a href="/" class="btn btn-prev">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.9167 17L7.08341 17" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 26.916L7.08333 16.9993L17 7.08268" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span><?= Yii::t('OtherModule.other', 'Back'); ?></span>
            </a>
            <h1><?= Yii::t('OtherModule.other', 'Place new order'); ?></h1>
        </div>
        <?php
            $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm',
                [
                    'action' => ['/order/order/create'],
                    'id' => 'order-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'clientOptions' => [
                        'validateOnSubmit' => true,
                        'validateOnChange' => false,
                        'validateOnType' => false,
                        'beforeValidate' => 'js:function(form){$(form).find("button[type=\'submit\']").prop("disabled", true); return true;}',
                        'afterValidate' => 'js:function(form, data, hasError){$(form).find("button[type=\'submit\']").prop("disabled", false); return !hasError;}',
                    ],
                    'htmlOptions' => [
                        'hideErrorMessage' => false,
                        'enctype' => 'multipart/form-data'
                    ]
                ]
            );
        ?>
            <div class="cart-main">
                <div class="cart-info">
                    <div class="cart-form">
                        <?php $this->widget('yupe\widgets\YFlashMessages'); ?>

                        <div class="cart-periods">
                            <select class="field-text js-input-period hidden" name="<?= get_class($order) ?>[rackcalcPeriod]" id="<?= get_class($order) ?>_rackcalcPeriod">
                                <?php foreach (Periods::getPeriods() as $item): ?>
                                    <option value="<?= $item->id; ?>" data-percent="<?= $item->cost; ?>" <?= $order->rackcalcPeriod === $item->id ? 'selected' : '' ?>><?= $item->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php foreach (Periods::getPeriods() as $key => $item): ?>
                                <div class="cart-period cart-period-<?= $key + 1; ?> js-cart-period" data-id="<?= $item->id; ?>">
                                    <div class="cart-period-main">
                                        <div class="cart-period-title"><?= $item->name; ?></div>
                                        <div class="cart-period-time"><?= $item->desc_small; ?></div>
                                    </div>
                                    <div class="cart-period-foot">
                                        <div class="cart-period-desc"><?= $item->desc; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <input class="js-input-page" type="hidden" value="<?= Yii::app()->getModule('rackcalc')->pricePage; ?>">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Subject'); ?></label>
                                    <div class="field-selected-wrap">
                                        <select class="field-selected js-input-subject" name="<?= get_class($order) ?>[rackcalcSubject]" id="<?= get_class($order) ?>_rackcalcSubject">
                                            <?php foreach (Subjects::getSubjects() as $item): ?>
                                                <option value="<?= $item->id; ?>" data-percent="<?= $item->cost; ?>" <?= $order->rackcalcSubject === $item->id ? 'selected' : '' ?>><?= $item->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Number of pages'); ?></label>
                                    <div class="field-selected-wrap">
                                        <select class="field-selected js-input-word" name="<?= get_class($order) ?>[rackcalcWord]" id="<?= get_class($order) ?>_rackcalcWord">
                                            <?php foreach (Words::model()->findAll() as $item): ?>
                                                <option value="<?= $item->id; ?>" data-percent="<?= $item->cost; ?>" <?= $order->rackcalcWord === $item->id ? 'selected' : '' ?>><?= $item->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""><?= Yii::t('OtherModule.other', 'Language'); ?></label>
                            <div class="field-selected-wrap">
                                <select class="field-selected js-input-subject" name="<?= get_class($order) ?>[rackcalcLanguage]" id="<?= get_class($order) ?>_rackcalcLanguage">
                                    <?php foreach (Language::getLanguages() as $item): ?>
                                        <option value="<?= $item->id; ?>" <?= $order->rackcalcLanguage === $item->id ? 'selected' : '' ?>><?= $item->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""><?= Yii::t('OtherModule.other', 'Order description'); ?></label>
                            <?= $form->textArea($order, 'comment', ['class' => 'field-textarea form-control']); ?>
                        </div>

                        <?= $form->errorSummary($order); ?>

                        <div class="form-group">
                            <label for=""><?= Yii::t('OtherModule.other', 'Name'); ?> *</label>
                            <?= $form->textField($order, 'name', ['class' => 'field-text form-control']); ?>
                            <?= $form->error($order, 'name'); ?>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Email'); ?> *</label>
                                    <?= $form->emailField($order, 'email', ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'email'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Phone'); ?></label>
                                    <?= $form->textField($order, 'phone', ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'phone'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Street Address'); ?></label>
                                    <?= $form->textField($order, 'street', ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'street'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Country'); ?></label>
                                    <?= CHtml::dropDownList('Order[country]', $order->country, User::getCountryList(), ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'country'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'City'); ?></label>
                                    <?= $form->textField($order, 'city', ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'city'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'Zipcode'); ?></label>
                                    <?= $form->textField($order, 'zipcode', ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'zipcode'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><?= Yii::t('OtherModule.other', 'State'); ?></label>
                                    <?= $form->textField($order, 'house', ['class' => 'field-text form-control']); ?>
                                    <?= $form->error($order, 'house'); ?>
                                </div>
                            </div>
                        </div>

                        <?php if(!empty($deliveryTypes)):?>
                            <?php foreach ($deliveryTypes as $key => $delivery): ?>
                                <div class="hidden">
                                    <input type="radio" name="Order[delivery_id]" id="delivery-<?= $delivery->id; ?>"
                                           value="<?= $delivery->id; ?>"
                                           data-price="<?= $delivery->price; ?>"
                                           data-free-from="<?= $delivery->free_from; ?>"
                                           data-available-from="<?= $delivery->available_from; ?>"
                                           data-separate-payment="<?= $delivery->separate_payment; ?>">
                                    <label for="delivery-<?= $delivery->id; ?>"></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif;?>

                        <div class='row'>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>File</label>
                                    <div class="file-input-container">
                                        <label for="Order_file" class="file-input-label btn btn-primary"><?= Yii::t('OtherModule.other', 'Upload file'); ?></label>
                                        <input class="file-input" type="file" id="Order_file" name="Order[file]">
                                        <span id="file-name" style="margin-left: 10px;font-size: 11px;"></span>
                                    </div>

                                    <div style="font-size: 11px;">
                                        <?= Yii::t('OtherModule.other', 'Upload any material (picture, article, instructions, notes etc) you want the writer to consider while crafting your paper.'); ?>
                                        <!--You can upload up to 3 files.-->
                                    </div>

                                    <script>
                                        document.getElementById('Order_file').addEventListener('change', function(e) {
                                            var fileName = '';
                                            if (this.files && this.files.length > 1) {
                                                // Если разрешена загрузка нескольких файлов
                                                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                                            } else {
                                                // Для одного файла
                                                fileName = e.target.value.split('\\').pop();
                                            }

                                            if (fileName) {
                                                document.getElementById('file-name').textContent = fileName;
                                            } else {
                                                document.getElementById('file-name').textContent = '';
                                            }
                                        });
                                    </script>
                                </div>

                                <!--
                                <?= $form->fileFieldGroup(
                                    $order,
                                    'file',
                                    [
                                        'widgetOptions' => [
                                            'htmlOptions' => [
                                                'style' => 'background-color: inherit;',
                                            ],
                                        ],
                                    ]
                                ); ?>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-total">
                    <div class="cart-total-title"><?= Yii::t('OtherModule.other', 'Total'); ?></div>

                    <div class="js-cart-total-har">
                        <div class="cart-total-har">
                            <div class="cart-total-har-label"><?= Yii::t('OtherModule.other', 'Deadline'); ?>:</div>
                            <div class="cart-total-har-value">Ultra Express</div>
                        </div>
                        <div class="cart-total-har">
                            <div class="cart-total-har-label"><?= Yii::t('OtherModule.other', 'Subject'); ?>:</div>
                            <div class="cart-total-har-value">Astronomy</div>
                        </div>
                        <div class="cart-total-har">
                            <div class="cart-total-har-label"><?= Yii::t('OtherModule.other', 'Number of pages'); ?>:</div>
                            <div class="cart-total-har-value">1500</div>
                        </div>
                    </div>

                    <div class="cart-total-coupon coupons js-coupons">
                        <input type="text" class="field-text" id="coupon-code" placeholder="<?= Yii::t('OtherModule.other', 'Enter the promo code'); ?>">

                        <?php foreach ($coupons as $coupon): ?>
                            <div class="coupons-items">
                                <span class="label alert alert-info coupon" title="<?= $coupon->name; ?>">
                                    <?= $coupon->code; ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <?= CHtml::hiddenField(
                                        "Order[couponCodes][{$coupon->code}]",
                                        $coupon->code,
                                        [
                                            'class' => 'coupon-input',
                                            'data-code' => $coupon->code,
                                            'data-name' => $coupon->name,
                                            'data-value' => $coupon->value,
                                            'data-type' => $coupon->type,
                                            'data-min-order-price' => $coupon->min_order_price,
                                            'data-free-shipping' => $coupon->free_shipping,
                                        ]
                                    );?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart-total-price">
                        <div class="cart-total-price-label"><?= Yii::t('OtherModule.other', 'Total price'); ?></div>
                        <div class="cart-total-price-value js-total-price"><?= Yii::app()->controller->currency; ?> 0.00</div>
                    </div>

                    <div class="cart-total-buts">
                        <button type="submit" class="btn btn-primary js-button-created" disabled><?= Yii::t('OtherModule.other', 'Order now'); ?></button>
                    </div>
                    <div class="cart-total-agree">
                        <div class="form-group d-flex flex-align-items-center flex-gap-3">
                            <?= $form->checkBox($order, 'terms'); ?>
                            <label for="Order_terms" style="margin-bottom: 0;">
                                <?= Yii::t('OtherModule.other', "I confirm my acceptance of") ?>
                                <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'terms-and-conditions']); ?>"><?= Yii::t('OtherModule.other', 'Terms And Conditions'); ?></a>
                                <?= Yii::t('OtherModule.other', "and") ?>
                                <a href="<?= Yii::app()->createUrl('/page/page/view', ['slug' => 'privacy-policy']); ?>"><?= Yii::t('OtherModule.other', 'Privacy Policy'); ?></a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="modal modal-created js-modal-created">
    <div class="modal-dialog">
        <div class="modal-head">
            <div class="modal-title title"><?= Yii::t("OtherModule.other", "Your order is being created"); ?></div>
        </div>
        <div class="modal-main">
            <p><?= Yii::t("OtherModule.other", "It is necessary to wait a little. In a few seconds, we will create a page for paying for the order."); ?></p>
            <?= file_get_contents(Yii::app()->theme->basePath . '/web/images/spinner.svg') ?>
        </div>
    </div>
</div>

<script>
    const elementPeriod = document.querySelector('.js-input-period')
    const elementSubject = document.querySelector('.js-input-subject')
    const elementWord = document.querySelector('.js-input-word')
    const elementTotal = document.querySelector('.js-total-price')

    const elementTotalHar = document.querySelector('.js-cart-total-har')

    const elementsPeriodCart = document.querySelectorAll('.js-cart-period')

    elementPeriod.addEventListener('change', function (event) {
        setPriceTotal()
        setTotalHar()
        setUrlParams()
    })

    elementSubject.addEventListener('change', function (event) {
        setPriceTotal()
        setTotalHar()
        setUrlParams()
    })

    elementWord.addEventListener('change', function (event) {
        setPriceTotal()
        setTotalHar()
        setUrlParams()
    })

    setPriceTotal()
    setTotalHar()

    function getPrices() {
        const pricePeriodOption = elementPeriod.options[elementPeriod.selectedIndex]
        const pricePeriodPercent = pricePeriodOption.getAttribute('data-percent')

        const priceSubjectOption = elementSubject.options[elementSubject.selectedIndex]
        const priceSubjectPercent = priceSubjectOption.getAttribute('data-percent')

        const priceWordOption = elementWord.options[elementWord.selectedIndex]
        const priceWordPercent = priceWordOption.getAttribute('data-percent')

        const priceWords = priceWordOption.text
        const pricePage = priceWordPercent

        return {
            period: Number(pricePeriodPercent),
            subject: Number(priceSubjectPercent),
            words: Number(priceWords),
            page: Number(pricePage)
        }
    }

    // Итоговая стоимость
    function getPricesPositions() {
        const priceObject = getPrices()
        const totalPriceSubject = priceObject.page + (priceObject.page * (priceObject.subject / 100))
        const totalPricePeriod = totalPriceSubject + (totalPriceSubject * (priceObject.period / 100))

        return ((priceObject.words * totalPricePeriod) * <?= Yii::app()->controller->currencyCoff > 0 ? Yii::app()->controller->currencyCoff : 1; ?>).toFixed(2)
    }

    function setPriceTotal() {
        const elementPeriodCartActive = document.querySelector('.js-cart-period[data-id="' + elementPeriod.value + '"]')

        if(elementPeriodCartActive) {
            elementPeriodCartActive.classList.add('active')
        }

        elementTotal.textContent = '<?= Yii::app()->controller->currency; ?> ' + getCartTotalCost()
    }

    elementsPeriodCart.forEach(element => {
        element.addEventListener('click', function (event) {
            const current = event.currentTarget

            elementPeriod.value = current.getAttribute('data-id')
            setPriceTotal()
            setTotalHar()
            setUrlParams()

            elementsPeriodCart.forEach(item => {
                item.classList.remove('active')
            })

            current.classList.add('active')
        })
    })

    $(document).on('blur', '#coupon-code', function() {
        couponAdd()
    });

    $(document).on('keypress', '#coupon-code', function(e) {
        if (e.which == 13) {
            e.preventDefault()
            couponAdd()
        }
    });

    function couponAdd() {
        const code = $('#coupon-code').val()

        if (code) {
            const data = {'code': code, 'price': getPricesPositions()}
            data[yupeTokenName] = yupeToken;

            $.ajax({
                url: '<?= Yii::app()->getLanguage() !== 'en' ? '/'.Yii::app()->getLanguage() : ''; ?>' + '/coupon/add',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.result) {
                        $.ajax({
                            type: 'GET',
                            url: window.location.href,
                            success: function (data) {
                                console.log($('.js-coupons'))
                                console.log($(data).find('.js-coupons'))
                                $('.js-coupons').html($(data).find('.js-coupons').html())

                                setPriceTotal()
                                setTotalHar()
                            }
                        })

                        // window.location.reload()
                    } else {
                        if(data.data && data.data.length > 0) {
                            alert(data.data[0])
                        }
                    }
                }
            })

            $('#coupon-code').val('')
        }
    }

    $(document).on('click', '.coupon .close', function(e) {
        e.preventDefault()
        const code = $(this).siblings('input[type="hidden"]').data('code')
        const data = {'code': code}
        data[yupeTokenName] = yupeToken
        $.ajax({
            url: '<?= Yii::app()->getLanguage() !== 'en' ? '/'.Yii::app()->getLanguage() : ''; ?>' + '/coupon/remove',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.result) {
                    setPriceTotal();
                }
            }
        })
    });

    // $('#coupon-code').keypress(function (e) {
    //     if (e.which == 13) {
    //         e.preventDefault()
    //         $('#add-coupon-code').click()
    //     }
    // })

    function getCartTotalCost() {
        let cost = getPricesPositions()
        let delta = 0;
        const coupons = getCoupons()

        $.each(coupons, function (index, el) {
            if (parseFloat(cost) >= parseFloat(el.min_order_price)) {
                switch (el.type) {
                    case 0: // $
                        delta += parseFloat(el.value)
                        break
                    case 1: // %
                        delta += (parseFloat(el.value) / 100) * cost
                        break
                }
            }
        })

        return delta > cost ? 0 : (cost - delta).toFixed(2)
    }

    function getCoupons() {
        let coupons = []
        $.each($('.coupon-input'), function (index, elem) {
            let $elem = $(elem)
            coupons.push({
                code: $elem.data('code'),
                name: $elem.data('name'),
                value: $elem.data('value'),
                type: $elem.data('type'),
                min_order_price: $elem.data('min-order-price'),
                free_shipping: $elem.data('free-shipping')
            })
        })

        return coupons
    }

    // Install har
    function setTotalHar() {
        const inputPeriodOption = elementPeriod.options[elementPeriod.selectedIndex]
        const inputSubjectOption = elementSubject.options[elementSubject.selectedIndex]
        const inputWordOption = elementWord.options[elementWord.selectedIndex]

        const div = `
            <div class="cart-total-har">
                <div class="cart-total-har-label"><?= Yii::t('OtherModule.other', 'Total price'); ?>:</div>
                <div class="cart-total-har-value">${inputPeriodOption.text}</div>
            </div>
            <div class="cart-total-har">
                <div class="cart-total-har-label"><?= Yii::t('OtherModule.other', 'Subject'); ?>:</div>
                <div class="cart-total-har-value">${inputSubjectOption.text}</div>
            </div>
            <div class="cart-total-har">
                <div class="cart-total-har-label"><?= Yii::t('OtherModule.other', 'Number of pages'); ?>:</div>
                <div class="cart-total-har-value">${inputWordOption.text}</div>
            </div>
        `

        elementTotalHar.innerHTML = div
    }

    function setUrlParams() {
        const url = new URL(window.location)
        url.searchParams.set("rackcalcPeriod", elementPeriod.value)
        url.searchParams.set("rackcalcSubject", elementSubject.value)
        url.searchParams.set("rackcalcWord", elementWord.value)

        history.pushState(null, '', url)
    }

    const modal = document.querySelector('.js-modal-created')
    const buttonCreated = document.querySelector('.js-button-created')

    buttonCreated.addEventListener('click', function () {
        if(modal) {
            modal.classList.add('modal--show')
        }
    })

    // Принятие terms
    const terms = document.querySelector('#Order_terms')
    terms.addEventListener('change', function () {
        buttonCreated.disabled = !terms.checked;
    })
</script>