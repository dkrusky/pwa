"use strict";

/* A version number is useful when updating the worker logic,
   allowing you to remove outdated cache entries during the update.
*/
var version = 'v1::';

/* These resources will be downloaded and cached by the service worker
   during the installation process. If any resource fails to be downloaded,
   then the service worker won't be installed either.
*/
var offlineFundamentals = [
  '',
  'layout/js/app.min.js'
];