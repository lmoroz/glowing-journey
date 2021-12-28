let mix = require('laravel-mix');

// https://laravel-mix.com/docs/main/extract

// выделяем отдельно vue чтобы подключать через
// assetBundle во вьюхи, где он нам нужен, см. assets/AuthAppAsset.php
mix.extract('public/vendor.js');

mix.js('src/auth/app.js', 'public/auth.js').vue();
mix.js('src/account/information/app.js', 'public/informationAccount.js').vue();
