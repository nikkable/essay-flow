<?php
/**
 * Файл настроек для модуля rackcalc
 *
 * @author Nikkable
 * @link https://vk.com/nikkable
 * @copyright 2024
 * @package yupe.modules.rackcalc.install
 * @since 0.1
 *
 */
return [
    'module'    => [
        'class' => 'application.modules.rackcalc.RackcalcModule',
    ],
    'import' => [
        'application.modules.rackcalc.models.*',
        'application.modules.rackcalc.components.helpers.*',
        'application.modules.rackcalc.forms.*',
    ],
    'component' => [
        'request'=>[
            'enableCsrfValidation' => true,
        ],
        'rackcalcRepository' => [
            'class' => 'application.modules.rackcalc.components.repository.RackcalcRepository'
        ],
    ],
    'rules'     => [

    ],
];
