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
let productionSourceMaps = false;


mix.sass('resources/sass/app.scss', 'public/css')
    .options({
        autoprefixer: {
            options: {
                browsers: [
                    'last 40 versions',
                ]
            }
        }
    })
    .sourceMaps(productionSourceMaps, 'source-map')
    .disableNotifications();