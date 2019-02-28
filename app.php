<?php
define('PATH', getcwd());

// Initialize router, view, and databse
include 'lib/defines.php';
include 'settings/configuration.php';
require 'lib/flight/flight/Flight.php';
require 'lib/smarty/libs/Smarty.class.php';
require 'lib/db.php';
require 'lib/webpages.php';

// Register Smarty as the view class
// Also pass a callback function to configure Smarty on load
Flight::register('view', 'Smarty', array(), function($smarty){
    $smarty->template_dir = 'layout/';
    $smarty->compile_dir = 'tmp/templates/';
    $smarty->cache_dir = 'tmp/cache/';
});
Flight::view()->assign('APP_VERSION', APP_VERSION);

// Register database class
Flight::register('db', 'DB');

/*** DO NOT TOUCH BELOW THIS LINE ***/
// handle routes that don't exist or unmatched parameters
Flight::map('notFound', function() {
    if(!defined('OUTPUT_SENT')) {
        define('OUTPUT_SENT', true);
        Flight::view()->assign( 'code', 404 );
        Flight::view()->display(PATH . '/layout/error.tpl');
    }
    Flight::stop();
});

// handle exceptions
Flight::map('error', function(Throwable $e) {
    if(!defined('OUTPUT_SENT')) {
        define('OUTPUT_SENT', true);
        Flight::view()->assign( 'code', 500 );
        if(LIVE === false) {
            // send error details to browser if in debug mode
            Flight::view()->assign( 'error', [
                    'message' => $e->getMessage(),
                    'code'    => $e->getCode(),
                    'e'       => $e
                ]
            );
        }
        Flight::view()->display(PATH . '/layout/error.tpl');
    }
    Flight::stop();
});

// Include router bootstrap
include 'settings/routes.php';

Flight::start();
