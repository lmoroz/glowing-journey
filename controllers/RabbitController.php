<?php

namespace app\controllers;

use app\jobs\TestJob;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class RabbitController extends Controller
{

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionTest($text): void
    {
        Yii::$app->queue->push(new TestJob(['text' => $text]));
    }
}