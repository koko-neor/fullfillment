const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .setPublicPath('public')
    .version();

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
});

mix.browserSync('http://127.0.0.1:8000/');

if (mix.inProduction()) {
    mix.version();
}
