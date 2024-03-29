const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 | .js('resources/js/app.js', 'public/assets/js/app.js')
 */


mix.sass('resources/assets/scss/sb-admin-2.scss', 'public/assets/css')
    .js('resources/js/app.js', 'public/assets/js')
    .js('node_modules/popper.js/dist/popper.js', 'public/assets/js').sourceMaps()
    .copy('resources/assets/js/sb-admin-2.js', 'public/assets/js/sb-admin-2.js')
    .copyDirectory('resources/assets/vendor', 'public/assets/vendor');

