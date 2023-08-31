<?php

/**
 * Plugin Name: AlxDev Settings
 * Description: дополнительные настройки для сайта. Настройка в коде - plugins/alxdev-settings/alxdev-settings.php
 * Version:     0.1
 * Plugin URI:  https://alxdev.ru/projects/wp/plugins/alxdev-settings
 * Author:      AlxDev
 * Author URI:  https://alxdev.ru
 */

require dirname(__FILE__) . '/classes/AlxDevSettingsPlugin.php';

$alxDevSettings = new AlxDevSettingsPlugin();


// configure this according to your purposes
// only text-type fields are supported so far
$alxDevSettings->settings = [
    'Contacts' => [
        'mysite-company-name' => Company legal name',
        'mysite-inn' => 'VAT number',
        'mysite-phone' => 'phone number',
        'mysite-email' => 'Email',
        'mysite-address' => 'Address',
    ],
    'Site blocks content' => [
        'mysite-copyright' => 'Copyright',
    ],
];


$alxDevSettings->init();
