<?php

namespace app\api\v1;


use app\api\v1\jobs\NewRequestJob;
use app\api\v1\models\Request;
use app\services\ImportParse\ImportRequestProcessor;
use Yii;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use yii\queue\amqp_interop\Queue;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\api\v1\controllers';

    public function init(): void
    {
        parent::init();
        Yii::$app->user->enableSession = false;
        Event::on(Request::class, BaseActiveRecord::EVENT_AFTER_INSERT, [self::class, 'pushToQueueRequest']);
    }

    public static function pushToQueueRequest(Event $event): void
    {
        /** @var Request $requestModel */
        $requestModel = $event->sender;
        /** @var Queue $queue */
        $queue = Yii::$app->queue;
        $queue->push(
            new NewRequestJob(
                Yii::$container->get(ImportRequestProcessor::class),
                ['requestId' => $requestModel->getPrimaryKey()]
            )
        );
    }
}
