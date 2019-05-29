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
   .sass('resources/sass/app.scss', 'public/css');

mix.copy('resources/js/custom.js', 'public/js/custom.js');
mix.copy('resources/js/multiselect.js', 'public/js/multiselect.js');
mix.copy('resources/js/timeline.js', 'public/js/timeline.js');
mix.copy('resources/js/mark_as_read.js', 'public/js/mark_as_read.js');
mix.copy('resources/sass/custom.css', 'public/css/custom.css');
mix.copy('resources/js/filter.js', 'public/js/filter.js');
