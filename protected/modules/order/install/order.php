<?php

return [
    'module' => [
        'class' => 'application.modules.order.OrderModule',
        'panelWidgets' => [
            'application.modules.order.widgets.PanelOrderStatWidget' => [
                'limit' => 5
            ]
        ],
    ],
    'import' => [
        'application.modules.order.models.*',
        'application.modules.order.helpers.*',
    ],
    'component' => [
        'eventManager' => [
            'class' => 'yupe\components\EventManager',
            'events' => [
                'order.pay.success' => [
                    ['PayOrderListener', 'onSuccessPay']
                ],
                'order.pay.failure' => [
                    ['PayOrderListener', 'onFailurePay']
                ],
                'http.order.created' => [
                    ['OrderListener', 'onCreate']
                ],
                'http.order.updated' => [
                    ['OrderListener', 'onUpdate']
                ]
            ]
        ],
        'orderNotifyService' => [
            'class' => 'application.modules.order.components.OrderNotifyService',
            'mail'  => 'mail'
        ],
    ],
    'rules' => [
        '/order/check'    => '/order/order/check',
        '/order/<url:\w+>' => 'order/order/view',
        '/order/<url:\w+>/invoice' => 'order/order/invoice',
        '/order/order/accumulations' => 'store/order/accumulations',
        '/order/order/payments' => 'store/order/payments',
        '/store/order/<action:\w+>' => 'order/order/<action>',
        '/store/account' => 'order/user/index',
        '/store/account/<action:\w+>' => 'order/user/<action>',
    ],
];
