<!DOCTYPE html>
<html lang="en" ng-app="WebsiteApp">
<head>
    <title>{$header->title}</title>
    <meta name="description" content="{$header->description}">
    <meta name="theme-color" content="{$THEME->COLOR}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="{$BASE_URL}manifest.json">
    <link rel="preload" as="style" onload="this.rel='stylesheet'" href="https://cdn.jsdelivr.net/combine/npm/@fortawesome/fontawesome-free@5.7.2/css/brands.min.css,npm/@fortawesome/fontawesome-free@5.7.2/css/fontawesome.min.css,npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <style>
      {literal}
      body { margin: 0; }
      .loader { z-index: 9999; position: absolute; top: 0; right: 0; bottom: 0; left: 0; background: blue; }
      [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak { display: none !important; }
      {/literal}
      {include file="loaders/$loader/index.min.css"}
    </style>

    <script>
    var serviceWorkerURI = '{$BASE_URL}layout/js/service-worker.min.js';
    {literal}
    (function(){
      // ServiceWorker is a progressive technology. Ignore unsupported browsers
      if ('serviceWorker' in navigator) {
        console.log('CLIENT: service worker registration in progress.');
        navigator.serviceWorker.register(serviceWorkerURI).then(function() {
          console.log('CLIENT: service worker registration complete.');
        }, function() {
          console.log('CLIENT: service worker registration failure.');
        });
      } else {
        console.log('CLIENT: service worker is not supported.');
      }
    })();
    {/literal}
    </script>

</head>
    <body>

        <div class="loader ng-hide">{include file="loaders/$loader/index.tpl"}</div>
        <div ng-controller="WebsiteController" ng-cloak>
