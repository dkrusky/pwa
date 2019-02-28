<?php
class SEO extends Core {

    // output manifest.json
    function manifest() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: application/json');
            $this->response([], 'raw/json');
        }
        Flight::stop();
    }

    // output sitemap.xml
    function sitemap() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: application/xml');
            $data = [
               [
                   'loc'	=> '/',

                   // ISO8601 DateTime object
                   'lastmod'	=> date(DateTime::ISO8601),

                   // always, hourly, daily, weekly, monthly, yearly, never
		   'changefreq' => 'weekly',

                   // priority of page from 0 to 1. null if unused (optional)
                   'priority'   => null
               ]

            ];

            $this->response([], 'raw/xml');
        }
        Flight::stop();
    }

    // output robots.txt
    function robots() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: text/plain');
            $this->response([], 'raw/text');
        }
        Flight::stop();
    }

}
