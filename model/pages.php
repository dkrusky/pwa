<?php
class Pages extends Core {

    // handler for site index page
    function index() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: text/html');
            $this->response([], 'index');
        }
        Flight::stop();
    }

}
