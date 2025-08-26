<?php

//$valid_passwords = array ("admin" => "adminadmin.");
//$valid_users = array_keys($valid_passwords);
//
//$user = $_SERVER['PHP_AUTH_USER'];
//$pass = $_SERVER['PHP_AUTH_PW'];
//
//$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);
//
//if (!$validated) {
//    header('WWW-Authenticate: Basic realm="My Realm"');
//    header('HTTP/1.0 401 Unauthorized');
//    die ("Not authorized");
//}

/**
 * Entry point script:
 *
 * @category YupeScript
 * @package  YupeCMS
 * @author   Yupe Team <team@yupe.ru>
 * @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 * @link     https://yupe.ru
 **/

/**
 * @link    http://www.yiiframework.ru/doc/guide/ru/basics.entry
 */

//mail('monshtrina@gmail.com', 'тема письма', 'тело письма', 'From: no-reply@essayonara.com');

if (!ini_get('date.timezone')) {
    date_default_timezone_set('Europe/Moscow');
}

// Setting internal encoding to UTF-8.
if (!ini_get('mbstring.internal_encoding')) {
    @ini_set("mbstring.internal_encoding", 'UTF-8');
    mb_internal_encoding('UTF-8');
}

// Comment next two lines on production
define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require __DIR__ . '/../vendor/yiisoft/yii/framework/yii.php';

$base = require __DIR__ . '/../protected/config/main.php';

$confManager = new yupe\components\ConfigManager();
$confManager->sentEnv(\yupe\components\ConfigManager::ENV_WEB);

require __DIR__ . '/../vendor/autoload.php';

Yii::createWebApplication($confManager->merge($base))->run();
