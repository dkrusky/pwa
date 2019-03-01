<?php
class Pages extends Core {

    // handler for site index page
    function index() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: text/html');
            try{
                $this->headers([
                    // title
                    'title'         =>  'Webpage App',

                    // description
                    'description'   =>  'A cool webpage that runs as an app'
                ]);

                $this->response([], 'index');

            } catch (Exception $e) {
                print_r($e); die();
            }
        }
        Flight::stop();
    }

}
