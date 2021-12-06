const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.css('node_modules/foundation-sites/dist/css/foundation.css', 'public/site/foundation.css')
    .scripts('node_modules/foundation-sites/dist/js/foundation.cjs.js', 'public/site/foundation.js')
