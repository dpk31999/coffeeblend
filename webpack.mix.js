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
    ], 'public/css/style.css');

mix.js('resources/js/main.js', 'public/js/main.js');
mix.js('resources/js/jquery.min.js', 'public/js/jquery.min.js');
mix.js('resources/js/jquery-migrate-3.0.1.min.js', 'public/js/jquery-migrate-3.0.1.min.js');
mix.js('resources/js/popper.min.js', 'public/js/popper.min.js');
mix.js('resources/js/bootstrap.min.js', 'public/js/bootstrap.min.js');
mix.js('resources/js/jquery.easing.1.3.js', 'public/js/jquery.easing.1.3.js');
mix.js('resources/js/jquery.waypoints.min.js', 'public/js/jquery.waypoints.min.js');
mix.js('resources/js/jquery.stellar.min.js', 'public/js/jquery.stellar.min.js');
mix.js('resources/js/owl.carousel.min.js', 'public/js/owl.carousel.min.js');
mix.js('resources/js/jquery.magnific-popup.min.js', 'public/js/jquery.magnific-popup.min.js');
mix.js('resources/js/aos.js', 'public/js/aos.js');
mix.js('resources/js/jquery.animateNumber.min.js', 'public/js/jquery.animateNumber.min.js');
mix.js('resources/js/bootstrap-datepicker.js', 'public/js/bootstrap-datepicker.js');
mix.js('resources/js/jquery.timepicker.min.js', 'public/js/jquery.timepicker.min.js');
mix.js('resources/js/scrollax.min.js', 'public/js/scrollax.min.js');