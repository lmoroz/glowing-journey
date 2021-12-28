<?php

namespace app\assets;

use yii\web\YiiAsset;

class AuthAppAsset extends AbstractVueAsset
{
    public $js = [
        'auth.js',
    ];

    public $depends = [
        YiiAsset::class,
        VueAsset::class,
    ];

}
