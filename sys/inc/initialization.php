<?php

/**
 * @const TIME_START Время запуска скрипта в миллисекундах
 */
define('TIME_START', microtime(true)); // время запуска скрипта

/**
 * @const SESSION_NAME имя сессии
 */
define('SESSION_NAME', 'CMS_SESSION');

// устанавливаем Московскую временную зону по умолчанию
if (@function_exists('ini_set')) {
    ini_set('date.timezone', 'Europe/Moscow');
}

define('SALT', "336681b5b447542b6b714c129d2cdc7d");

function pass_hash($pass) {
    return md5(SALT . md5((string) $pass) . md5(SALT) . SALT);
}

@session_name(SESSION_NAME) or die('Невозможно инициализировать сессии');
@session_start() or die('Невозможно инициализировать сессии');