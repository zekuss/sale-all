<?php
/**
 * Created by PhpStorm.
 * User: Zakusilo
 * Date: 20.03.2017
 * Time: 10:34
 */

session_start();
CModule::AddAutoloadClasses(
    '', // не указываем имя модуля
    array(
        // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
        'krumo' => '/bitrix/php_interface/plugins/krumo/class.krumo.php',
        'CFileCSV' => '/bitrix/php_interface/plugins/class.cfilecsv.php',
    )
);