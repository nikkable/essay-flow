<?php
/** @var Page $page */

Yii::import('application.modules.other.OtherModule');

if ($page->layout) {
    $this->layout = "//layouts/{$page->layout}";
}

$this->title = $page->meta_title ?: $page->title;
$this->description = !empty($page->meta_description) ? $page->meta_description : Yii::app()->getModule('yupe')->siteDescription;

?>

<div class="screen">
    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'screen', 'view' => 'screen']); ?>
</div>

<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every', 'view' => 'every']); ?>

<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted', 'view' => 'trusted']); ?>

<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'our', 'view' => 'our']); ?>

<div class="bg">
    <div class="container">
        <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-black', 'view' => 'every-black']); ?>

        <?php if(!Yii::app()->user->checkAccess('author')): ?>
            <div class="order-home">
                <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'order', 'view' => 'order']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'every-two', 'view' => 'every-two']); ?>

<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'trusted-two', 'view' => 'trusted-two']); ?>

<div class="question" id="faq">
    <?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'questions', 'view' => 'question']); ?>
</div>

<?php $this->widget('application.modules.contentblock.widgets.ContentMyBlockWidget', ['code' => 'started', 'view' => 'started']); ?>

<script>
    const elementPeriod = document.querySelector('.js-input-period')
    const elementSubject = document.querySelector('.js-input-subject')
    const elementWord = document.querySelector('.js-input-word')
    const elementTotal = document.querySelector('.js-total-price')

    const elementsPeriodCart = document.querySelectorAll('.js-cart-period')

    elementPeriod.addEventListener('change', function (event) {
        setPriceTotal()
    })

    elementSubject.addEventListener('change', function (event) {
        setPriceTotal()
    })

    elementWord.addEventListener('change', function (event) {
        setPriceTotal()
    })

    setPriceTotal()

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

        elementTotal.textContent = '<?= Yii::app()->controller->currency; ?> ' + getPricesPositions()
    }

    const elementOrderButton = document.querySelector('.js-order-new')
    elementOrderButton.addEventListener('click', function (event) {
        event.preventDefault()

        location.href = '<?= Yii::app()->getLanguage() !== 'en' ? '/'.Yii::app()->getLanguage() : ''; ?>' + '/cart?' + 'rackcalcPeriod=' + elementPeriod.value + '&rackcalcSubject=' + elementSubject.value + '&rackcalcWord=' + elementWord.value
    })
</script>
