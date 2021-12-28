<?php

namespace app\assets\account;

use app\assets\AbstractVueAsset;
use app\assets\VueAsset;
use yii\web\YiiAsset;

class EditInformationAsset extends AbstractVueAsset
{
    public $js = [
        'informationAccount.js',
    ];

    public $depends = [
        YiiAsset::class,
        VueAsset::class,
    ];
}
