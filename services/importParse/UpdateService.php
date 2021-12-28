<?php


namespace app\services\ImportParse;


use app\api\v1\models\Request;
use app\models\Lot;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class UpdateService
{

    public function update(Request $request): int
    {
        $counter = 0;
        $data = $request->getRaw();
        if (is_array($data) && count($data) > 0) {
            $ids = ArrayHelper::getColumn($data, 'hash');
            $lots = Lot::find()->where(['hash' => $ids])->indexBy('hash')->all();
            foreach ($data as $datum) {
                $hash = $datum['hash'] ?? null;
                if ($lots[$hash] === null) {
                    continue;
                }

                /** @var Lot $model */
                $model = $lots[$hash];
                $model->setAttributes($datum, false);
                try {
                    $model->save(false);
                    $counter++;
                } catch (Exception $exception) {
                    Yii::error($exception->getMessage(), 'cli');
                }
            }
        }
        return $counter;
    }
}