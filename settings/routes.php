<?php
/*****************
 * ROUTES: BEGIN *
 *****************/

// Includes
require 'model/pages.php';
require 'model/seo.php';

$pages = new Pages();
Flight::route('GET /',                                                                    [ $pages, 'index'] );

$seo = new SEO();
Flight::route('GET /manifest.json',                                                       [ $seo, 'manifest' ] );
Flight::route('GET /robots.txt',                                                          [ $seo, 'robots' ] );
Flight::route('GET /sitemap.xml',                                                         [ $seo, 'sitemap' ] );

/****************
 * ROUTES: END  *
 ****************/
