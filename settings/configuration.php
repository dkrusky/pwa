<?php
// set the version of your application
define('APP_VERSION',	        '1.0.0.0');

// the app name and database prefix
define('DB_PREFIX',             'pwa');

// use live or test database config
define('LIVE',                  false);

// valid values LOG_NONE, LOG_REQUEST, LOG_RESPONSE, LOG_ALL
define('LOG_LEVEL',             LOG_ALL);

/**
  PAGE, PWA, AND SEO SETTINGS
**/
// the relative path where this application is installed
define('BASE_URL',              '/pwa/');

/**
  MANIFEST / PWA DETAILS
**/
define('THEME_COLOR',           '');
define('THEME_ICONS',           [
    '192'   =>  'images/icons/192.png',
    '256'   =>  'images/icons/256.png'
]);
define('THEME_START_URL',       BASE_URL);
define('THEME_SCOPE_URL',       BASE_URL);
define('THEME_APP_NAME',        '');
define('THEME_APP_NAME_SHORT',  THEME_APP_NAME);
