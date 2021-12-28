<?php


namespace app\services\ImportParse;


use app\api\v1\models\Request;
use app\models\Lot;
use Yii;
use yii\db\Connection;
use yii\db\Exception;

class CreateService
{
    private Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function create(Request $request): int
    {
        $counter = 0;
        $data = $request->getRaw();
        if (is_array($data) && count($data) > 0) {
            $colums = array_keys($data[array_key_first($data)]);
            try {
                $counter += $this->db
                    ->createCommand()
                    ->batchInsert(Lot::tableName(), $colums, $data)
                    ->execute();
            } catch (Exception $exception) {
                Yii::error($exception->getMessage(), 'cli');
            }
        }
        return $counter;
    }
}