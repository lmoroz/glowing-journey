<?php

namespace app\services\ImportParse;

use app\api\v1\models\Request;
use Yii;

class ImportRequestProcessor
{
    private int $rowsCreated = 0;
    private int $rowsUpdated = 0;
    private CreateService $createService;
    private UpdateService $updateService;

    public function __construct(CreateService $createService, UpdateService $updateService)
    {
        $this->createService = $createService;
        $this->updateService = $updateService;
    }

    public function process(Request $request): void
    {
        $transaction = Yii::$app->db->beginTransaction();
        if ($request->type === Request::TYPE_ADD) {
            $this->rowsCreated += $this->createService->create($request);
        } elseif ($request->type === Request::TYPE_UPDATE) {
            $this->rowsUpdated += $this->updateService->update($request);
        }
        $request->is_processed = true;
        $request->save(false);
        if (isset($transaction)) {
            $transaction->commit();
        }
    }

    public function getRowsCreated(): int
    {
        return $this->rowsCreated;
    }

    public function getRowsUpdated(): int
    {
        return $this->rowsUpdated;
    }

}