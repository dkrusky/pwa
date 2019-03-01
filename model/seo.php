<?php
class SEO extends Core {

    // output manifest.json
    function manifest() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: application/json');
            $icons = [];
            foreach(THEME['ICONS'] as $key=>$value) {
                $icons[] = [
                    'src'           =>  $value,
                    'type'          =>  'image/png',
                    'sizes'         =>  $key . 'x' . $key
                ];
            }

            $manifest = [
              'display'             =>  'standalone',
              'name'                =>  THEME['NAME'],
              'short_name'          =>  THEME['NAME_SHORT'],
              'scope'               =>  THEME['SCOPE_URL'],
              'start_url'           =>  THEME['START_URL'],
              'background_color'    =>  THEME['COLOR'],
              'theme_color'         =>  THEME['COLOR'],
              'icons'               =>  $icons
            ];

            Flight::view()->debugging = false;
            $this->response($manifest, 'raw/json');

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
                   'priority'   => 1
               ]

            ];

            Flight::view()->debugging = false;
            $this->response($data, 'raw/xml');
        }
        Flight::stop();
    }

    // output robots.txt
    function robots() {
        if($this->method === 'GET' && !defined('OUTPUT_SENT')) {
            header('Content-Type: text/plain');

            $robots = [ 'value' =>
'User-Agent: *
Disallow: ' . BASE_URL . '/_/*
Allow: ' . BASE_URL . '/

User-agent: Mediapartners-Google
Disallow: ' . BASE_URL . '/

User-agent: Yahoo Pipes 1.0
Disallow: ' . BASE_URL . '/

User-agent: 008
Disallow: ' . BASE_URL . '/

User-agent: voltron
Disallow: ' . BASE_URL . '/

User-agent: Googlebot-Image
Disallow: ' . BASE_URL . '/layout/images/*

Sitemap: ' . CANONICAL_BASE_URL . '/sitemap.xml';
];
            $this->response($robots, 'raw/text');
        }
        Flight::stop();
    }

}
