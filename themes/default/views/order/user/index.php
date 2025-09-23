<?php
/* @var $orders Order[] */

Yii::import('application.modules.other.OtherModule');

$mainAssets = Yii::app()->getTheme()->getAssetsUrl();

$this->title = Yii::t('OtherModule.other', 'My orders');
?>

<div class="container m-t-5 m-b-5" style="padding-bottom: 50px;">
    <a href="/" class="btn btn-prev">
        <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M26.9167 17L7.08341 17" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17 26.916L7.08333 16.9993L17 7.08268" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span><?= Yii::t('OtherModule.other', 'Back'); ?></span>
    </a>
    <div class="d-flex flex-wrap flex-justify-content-between flex-align-items-center flex-gap-3 m-b-3">
        <h1><?= Yii::t("OtherModule.other", "My orders"); ?></h1>
        <div>
            <?php if(!Yii::app()->user->checkAccess('author')): ?>
                <a href="/cart" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Create new order"); ?></a>
            <?php endif; ?>
            <?php if(Yii::app()->user->checkAccess('author')): ?>
                <a href="<?= Yii::app()->createUrl('/order/order/accumulations') ?>" class="btn btn-primary"><?= Yii::t("OtherModule.other", "Earnings history"); ?></a>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <a href="<?= Yii::app()->createUrl('/order/user/index') ?>" class="btn <?= Yii::app()->request->getQuery('status') ? 'btn-secondary' : 'btn-primary'; ?>"><?= Yii::t("OtherModule.other", "All orders"); ?></a>
        <a href="<?= Yii::app()->createUrl('/order/user/index', ['status' => Order::STATUS_IN_WORK]) ?>" class="btn <?= Yii::app()->request->getQuery('status') == Order::STATUS_IN_WORK ? 'btn-primary' : 'btn-secondary'; ?>"><?= Yii::t("OtherModule.other", "In progress"); ?></a>
        <a href="<?= Yii::app()->createUrl('/order/user/index', ['status' => Order::STATUS_DONE]) ?>" class="btn <?= Yii::app()->request->getQuery('status') == Order::STATUS_DONE ? 'btn-primary' : 'btn-secondary'; ?>"><?= Yii::t("OtherModule.other", "Done"); ?></a>
    </div>

    <br>

    <?php
        $emptyText = Yii::t("OtherModule.other", 'No results found');

        if($user->author_verification_status != USER::AUTHOR_VERIFICATION_VERIFIED) {
            $emptyText = Yii::t("OtherModule.other", 'Orders will appear here after your account is verified.');
        }

        if(!Yii::app()->user->checkAccess('author')) {
            $emptyText = Yii::t("OtherModule.other", 'Your order list is empty. Create your first order now!');
        }
    ?>

    <?php $this->widget(
        'bootstrap.widgets.TbListView',
        [
            'dataProvider' => $dataProvider,
            'id' => '',
            'itemView' => '_item',
            'summaryText' => '',
            'template'=>'{items} {pager}',
            'itemsCssClass' => 'order-lists',
            'ajaxUpdate'=> true,
            'pagerCssClass' => 'pagination-box',
            'emptyText' => '<div class="empty-results">' . $emptyText . '</div>',
            'pager' => [
                'header' => '',
                'lastPageLabel' => Yii::t("OtherModule.other", "Last page"),
                'firstPageLabel' => Yii::t("OtherModule.other", "First page"),
                'prevPageLabel' => Yii::t("OtherModule.other", "Prev page"),
                'nextPageLabel' => Yii::t("OtherModule.other", "Next page"),
                'maxButtonCount' => 5,
                'htmlOptions' => [
                    'class' => 'pagination'
                ],
            ]
        ]
    ); ?>
</div>

<div class="modal js-modal-order-completed">
    <div class="modal-dialog">
        <button class="btn modal-close js-modal-close">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.75 5.25L5.25 18.75" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.75 18.75L5.25 5.25" stroke="#535F7C" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <div class="modal-head">
            <div class="modal-title title"><?= Yii::t("OtherModule.other", "Requires verification"); ?></div>
        </div>
        <div class="modal-main">
            <p>
                <?= Yii::t("OtherModule.other", "You need to send the completed task file to"); ?> <a href="mailto:<?= Yii::app()->getModule('yupe')->email; ?>"><?= Yii::app()->getModule('yupe')->email; ?></a> <?= Yii::t("OtherModule.other", "for verification. After the review, the result will be sent to the user, and the order status will change to 'Completed.' Please include the order number in the email."); ?>
            </p>
            <p><?= Yii::t("OtherModule.other", "If you have sent the task for verification, click the 'Done' button."); ?></p>
            <br>
            <p>
                <a href="#" class="btn btn-primary js-order-completed-done"><?= Yii::t("OtherModule.other", "Done"); ?></a>
            </p>
        </div>
    </div>
</div>

<script>
    const btnOrdersCompleted = document.querySelectorAll('.js-order-completed')
    const modalOrderCompleted = document.querySelector('.js-modal-order-completed')

    btnOrdersCompleted.forEach(btnOrderCompleted => {
        btnOrderCompleted.addEventListener('click', (event) => {
            event.preventDefault()

            if(modalOrderCompleted) {
                modalOrderCompleted.classList.add('modal--show')
                const btn = modalOrderCompleted.querySelector('.js-order-completed-done')
                btn.href = btnOrderCompleted.href
            }
        })
    })
</script>

