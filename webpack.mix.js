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

// // backend
// mix.styles([
//     'resources/backend/css/style.css',
//     'resources/backend/css/header.css',
//     'resources/backend/css/footer.css',
//     'resources/backend/css/faq.css',
//     'resources/backend/css/conclusion-generator.css',
//     'resources/backend/scss/paraphrasing-tool.scss',
//     // 'resources/backend/css/paraphrasing-tool.css',
//     'resources/backend/css/essay-maker.css',
// ], 'public/backend/css/style.min.css');

// backend
mix.sass('resources/backend/scss/paraphrasing-tool.scss', 'public/backend/css/style.min.css')
    .css('resources/backend/css/style.css', 'public/backend/css/style.min.css')
    .css('resources/backend/css/header.css', 'public/backend/css/style.min.css')
    .css('resources/backend/css/footer.css','public/backend/css/style.min.css')
    .css('resources/backend/css/faq.css', 'public/backend/css/style.min.css')
    .css('resources/backend/css/conclusion-generator.css', 'public/backend/css/style.min.css')
    .css('resources/backend/css/essay-maker.css', 'public/backend/css/style.min.css');

mix.scripts([
    'resources/backend/js/jquery.js',
    'resources/backend/js/script.js',
    'resources/backend/js/validator.js',
    'resources/admin/js/plugin/sweetalert/sweetalert.min.js',
    'resources/backend/js/conclusion-generator.js',
    'resources/backend/js/paraphrasing-tool.js',
    'resources/backend/js/essay-maker.js',
], 'public/backend/js/script.min.js');

mix.copyDirectory('resources/backend/img', 'public/backend/img');
mix.copyDirectory('resources/backend/favicon', 'public/backend/favicon');
mix.copyDirectory('resources/backend/fonts', 'public/backend/fonts');

// admin
mix.copyDirectory('resources/admin', 'public/admin');
