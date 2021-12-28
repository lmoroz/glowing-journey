<?php


namespace app\commands;


use app\api\v1\models\Request;
use app\services\ImportParse\ImportRequestProcessor;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class ImportParseController extends Controller
{

    private ImportRequestProcessor $processor;

    public function __construct($id, $module, ImportRequestProcessor $processor, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->processor = $processor;
    }

    public function actionIndex(): int
    {
        $requests = Request::find()->where(['is_processed' => false])->all();
        foreach ($requests as $request) {
            $this->processor->process($request);
        }
        Yii::info("row create {$this->processor->getRowsCreated()}");
        Yii::info("row update {$this->processor->getRowsUpdated()}");
        return ExitCode::OK;
    }
}
