<?php
class Core {
    var $db;
    var $method = 'GET';
    var $request = null;

    function __construct() {
        $this->db = Flight::db();
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        if( in_array( $this->method, [ 'PUT', 'POST', 'PATCH' ] ) ) { $this->request = Flight::request()->data->request; }
    }

    /**
     *
     ^ Global error handler
     *
     * @param    object  $e The error object
     *
     **/
    function handler($e) {

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

        return true;
    }

    /**
     *
     ^ Send response information to client
     *
     * @param    array  $data The data to reply with
     * @param    string $success The template name and path relative to the template path. (in /layout/ )
     *
     **/
    public function response(?array $data, string $template = 'index') {
        if(!defined('OUTPUT_SENT')) {
            define('OUTPUT_SENT', true);
            Flight::view()->assign( 'data', $data );
            Flight::view()->display(PATH . '/layout/' . $template . '.tpl');
        }
        Flight::stop();
    }

}
