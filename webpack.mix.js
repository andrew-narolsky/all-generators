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

// backend
mix.styles([
    'resources/backend/css/style.css',
], 'public/backend/css/style.min.css');

mix.scripts([
    'resources/backend/js/jquery.js',
    'resources/backend/js/script.js',
    'resources/backend/js/validator.js',
    'resources/backend/js/conclusion-generator.js',
], 'public/backend/js/script.min.js');

mix.copyDirectory('resources/backend/img', 'public/backend/img');
mix.copyDirectory('resources/backend/favicon', 'public/backend/favicon');
mix.copyDirectory('resources/backend/fonts', 'public/backend/fonts');

// admin
mix.copyDirectory('resources/admin', 'public/admin');
