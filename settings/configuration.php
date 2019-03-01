<?php
// set the version of your application
define('APP_VERSION',	        '1.0.0.0');

// the app name and database prefix
define('DB_PREFIX',             'pwa');

// use live or test database config
define('LIVE',                  false);

// valid values LOG_NONE, LOG_REQUEST, LOG_RESPONSE, LOG_ALL
define('LOG_LEVEL',             LOG_ALL);

// set whether or not to display errors for debugging
define('DEBUG_MODE',            false);

/**
  PAGE, PWA, AND SEO SETTINGS
**/
// the relative path where this application is installed
define('BASE_URL',              '/pwa/');

// the absolute root path for canonical links
define('CANONICAL_BASE_URL',    'https://my.microvb.com');

// set the loader indicator type ( curves, boxes )
define('LOADER_STYLE',          'curves');

/**
  MANIFEST / PWA DETAILS
**/

define('THEME',
    [
        'COLOR'     =>      '#c0c0c0',
        'ICONS'     =>      [
            '192'   =>  'layout/images/icons/192.png',
            '256'   =>  'layout/images/icons/256.png',
            '512'   =>  'layout/images/icons/512.png'
        ],
        'START_URL' =>      BASE_URL,
        'SCOPE_URL' =>      BASE_URL,
        'NAME'      =>      'Website App',
        'NAME_SHORT'=>      'Website'
    ]
);
