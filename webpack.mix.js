const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'resources/css/animate.css',
        'resources/css/aos.css',
        'resources/css/bootstrap-datepicker.css',
        'resources/css/flaticon.css',
        'resources/css/ionicons.min.css',
        'resources/css/jquery.timepicker.css',
        'resources/css/magnific-popup.css',
        'resources/css/open-iconic-bootstrap.min.css',
        'resources/css/owl.carousel.min.css',
        'resources/css/owl.theme.default.min.css',
        'resources/css/style.css',
        'resources/css/ionicons.css',
        'resources/css/icomoon.css'
    ], 'public/css/style.css');

mix.styles([
    'resources/css/font-face.css',
    'resources/css/theme.css'
], 'public/css/admin.css');