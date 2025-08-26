<?php

return [
    'module' => [
        'class' => 'application.modules.katarun.KatarunModule',
    ],
    'component' => [
        'paymentManager' => [
            'paymentSystems' => [
                'katarun' => [
                    'class' => 'application.modules.katarun.components.payments.KatarunPaymentSystem',
                ]
            ],
        ],
    ],
];
