<?php


namespace app\widgets;


use app\assets\AuthAppAsset;
use yii\base\Widget;
use yii\helpers\Html;

class AuthForm extends Widget
{
    public function init(): void
    {
        $this->getView()->registerJsVar('config_apiPath', '/api');
        AuthAppAsset::register($this->getView());
        parent::init();
    }

    public function run(): string
    {
        return Html::tag('div', '', ['id' => 'vueAuthForm']);
    }
}
