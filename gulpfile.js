var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.styles([
        'metisMenu.css',
        'sb-admin-2.css'
    ]).sass(
        'app.scss'
    ).scripts([
        'app.js',
        'bootstrap.js',
        'metisMenu.js',
        'sb-admin-2.js'
    ]);
});