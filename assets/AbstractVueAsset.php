<?php


namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;

abstract class AbstractVueAsset extends AssetBundle
{
    public $sourcePath = '@app/vue-frontend/public';

    public $jsOptions = [
        'position' => View::POS_END,
    ];
}