<?php

namespace app\api\v1\jobs;

use app\api\v1\models\Request;
use app\services\ImportParse\ImportRequestProcessor;
use DomainException;
use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

final class NewRequestJob extends BaseObject implements JobInterface
{
    public int $requestId;

    private ImportRequestProcessor $processor;

    public function __construct(ImportRequestProcessor $processor, $config = [])
    {
        parent::__construct($config);
        $this->processor = $processor;
    }

    public function execute($queue): void
    {
        Yii::info('Приступили к обработке request '.$this->requestId, 'events');
        $request = Request::findOne(['id' => $this->requestId]);
        if ($request === null) {
            Yii::error('Запрос не найден', 'events:'.self::class);
            throw new DomainException('Не найдено');
        }
        $this->processor->process($request);
    }
}