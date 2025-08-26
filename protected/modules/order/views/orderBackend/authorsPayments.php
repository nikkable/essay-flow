<?php
Yii::app()->getClientScript()->registerCssFile($this->module->getAssetsUrl().'/css/order-backend.css');

$this->breadcrumbs = [
    Yii::t('OrderModule.order', 'Authors payments') => ['/order/orderBackend/authorsPayments'],
    Yii::t('OrderModule.order', 'Manage'),
];

$this->pageTitle = Yii::t('OrderModule.order', 'Orders - manage');

//$this->menu = [
//    [
//        'label' => Yii::t('OrderModule.order', 'Orders'),
//        'items' => [
//            [
//                'icon' => 'fa fa-fw fa-list-alt',
//                'label' => Yii::t('OrderModule.order', 'Manage orders'),
//                'url' => ['/order/orderBackend/index'],
//            ],
//            [
//                'icon' => 'fa fa-fw fa-plus-square',
//                'label' => Yii::t('OrderModule.order', 'Create order'),
//                'url' => ['/order/orderBackend/create'],
//            ],
//        ],
//    ],
//];
?>
<div>
    <h1>
        <?= Yii::t('OrderModule.order', 'Authors payments'); ?>
        <small><?= Yii::t('OrderModule.order', 'manage'); ?></small>
    </h1>
</div>


<?php

$this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id' => 'author_payments-grid',
        'type' => 'condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'actionsButtons' => false,
        'columns' => [
            'author_id',
            [
                'header' => Yii::t('OrderModule.order', 'Author email'),
                'value' => function ($data) {
                    return $data->author->email;
                },
                'type' => 'raw'
            ],
            'cart_number',
            'cart_name',
            'currency',
            [
                'name' => 'hold',
                'value' => function ($data) {
                    return Yii::app()->getNumberFormatter()->formatCurrency($data->hold,
                        Yii::app()->getModule('store')->currency);
                },
            ],
            [
                'name' => 'paid',
                'value' => function ($data) {
                    return Yii::app()->getNumberFormatter()->formatCurrency($data->paid,
                        Yii::app()->getModule('store')->currency);
                },
            ],
            [
                'header' => Yii::t('OrderModule.order', 'Status'),
                'value' => function ($data) {
                    return $data->hold > 0 ? '<span style="background: yellow;padding: 2px 5px;border-radius: 4px;">Waiting</span>' : '<span style="background: green;color: white;padding: 2px 5px;border-radius: 4px;">Paid</span>';
                },
                'type' => 'raw'
            ],
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
                'template' => '{done}{delete}',
                'buttons' => [
                    'done' => [
                        'icon'  => 'fa fa-fw fa-star',
                        'label' => Yii::t('OrderModule.order', 'Pay out'),
                        'url'   => 'Yii::app()->createUrl("/order/orderBackend/authorsPaymentsDone", array("id" => $data->id))',
                        'options' => ['class' => 'btn btn-sm btn-default'],
                        'visible' => function ($row, AuthorPayments $authorPayments) {
                            return $authorPayments->hold > 0;
                        },
                    ],
                    'delete' => [
                        'url'   => 'Yii::app()->createUrl("/order/orderBackend/authorsPaymentsDelete", array("id" => $data->id))',
                    ]
                ],
            ],
        ],
    ]
);

?>
