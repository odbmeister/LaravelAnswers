const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap.css')
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.bundle.js')
    .copy('node_modules/@popperjs/core/dist/umd/popper.js', 'public/js/popper.js');
