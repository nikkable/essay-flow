<?php
/**
 */
return [
    'module'    => [
        'class' => 'application.modules.faq.FaqModule',
    ],
    'import'    => [
        'application.modules.faq.models.*',
        'application.modules.faq.components.*',
        'application.modules.faq.FaqModule',
    ],
    'component' => [],
    'rules'     => [
//        '/faq/' => 'faq/faq/index',
//        '/faq/<slug>' => 'faq/faq/view',
    ],
];