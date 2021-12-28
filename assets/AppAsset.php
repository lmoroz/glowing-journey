<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap',
        'css/normalize.min.css',
        'css/bootstrap.min.css',
        'css/owl.carousel.min.css',
        'css/custom.css',
        'css/media.css',
    ];
    public $js = [
        'js/jquery-3.5.1.min.js',
        'js/jquery.inputmask.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/moby.min.js',
        'js/owl.carousel.min.js',
        'js/main.js',
    ];
}
