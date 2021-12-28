<?php

namespace app\api\v1\models;

use DateTimeImmutable;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%requests}}".
 *
 * @property int $id
 * @property string $type
 * @property int $time
 * @property string $request
 * @property string $raw
 * @property bool $is_processed
 *
 */
class Request extends ActiveRecord
{
    public const TYPE_ADD = 'add';
    public const TYPE_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%requests}}';
    }

    public function beforeSave($insert): bool
    {
        if (!$this->time) {
            unset($this->time);
        } else {
            $this->time = (new DateTimeImmutable($this->time))->format('Y-m-d');
        }
        return parent::beforeSave($insert);
    }

    public function getRaw(): array
    {
        $object = Json::decode($this->raw);
        if (is_array($object)) {
            return $object;
        }
        return [];
    }
}
