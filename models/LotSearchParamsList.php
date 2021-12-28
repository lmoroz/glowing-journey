<?php
/** @noinspection ALL */


namespace app\models;


use yii\data\Sort;
use yii\db\Connection;
use yii\db\Query;

/**
 * @property mixed key
 */
final class LotSearchParamsList
{
    public const SORT_QUANTITY_10 = 10;
    public const SORT_QUANTITY_15 = 15;
    public const SORT_QUANTITY_20 = 20;
    public const SORT_QUANTITY_25 = 25;

    private array $selectAttr = ['brand', 'model'];

    private array $brandList = [];
    private array $modelList = [];

    public function __construct(Connection $db)
    {
        $result = $db->cache(function ($db) {
            $query = new Query();
            $query->select($this->selectAttr)->from(Lot::tableName());

            /** @var Connection $db */
            $qb = $db->queryBuilder->build($query);
            return $db->createCommand($qb[0])->queryAll();

        });
        foreach ($result as $item) {
            foreach ($this->selectAttr as $attr) {
                $key = $attr.'List';
                if (isset($item[$attr])) {
                    $this->$key[$item[$attr]] = $item[$attr];
                }
            }
        }
    }

    public function getBrandList(): array
    {
        return $this->brandList;
    }

    public function getModelList(): array
    {
        return $this->modelList;
    }

    public function getStatusList(): array
    {
        return [
            Lot::STATUS_OPEN => 'Открыт',
            Lot::STATUS_CLOSED => 'Закрыт',
        ];
    }

    public function getSortQuantityList(): array
    {
        return [
            self::SORT_QUANTITY_10,
            self::SORT_QUANTITY_15,
            self::SORT_QUANTITY_20,
            self::SORT_QUANTITY_25,
        ];
    }

    public function getSortList(): array
    {
        return [
            SORT_ASC => 'По возрастанию',
            SORT_DESC => 'По убыванию'
        ];
    }

}