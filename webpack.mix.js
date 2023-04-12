const mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/assets')
    .js('node_modules/jquery/dist/jquery.js', 'public/assets')
    .sass('resources/scss/app.scss', 'public/assets');

