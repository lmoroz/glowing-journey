<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class LotSearch extends Lot
{
    public int $pageSize = LotSearchParamsList::SORT_QUANTITY_10;
    public int $sort = SORT_DESC;

    public function rules(): array
    {
        return [
            [
                [
                    'id',
                    'is_active',
                    'owners',
                    'lot_number',
                    'bid',
                    'start_date',
                    'end_date',
                    'mid_price',
                    'start_price',
                    'buy_now_price',
                    'pageSize',
                    'sort',
                ], 'integer'],
            [
                [
                    'hash',
                    'url',
                    'brand',
                    'model',
                    'year',
                    'mileage',
                    'engine',
                    'fuel',
                    'volume',
                    'power',
                    'transmission',
                    'drive',
                    'body',
                    'color',
                    'city',
                    'country',
                    'condition',
                    'comment',
                    'registration_end',
                    'vin',
                    'auc_type',
                    'photos_string'
                ], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Lot::find();

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        $dataProvider->pagination->pageSize = $this->pageSize;
        $query->orderBy(['brand' => $this->sort]);

        $query->andFilterWhere(
            [
                'is_active' => $this->is_active,
                'owners' => $this->owners,
                'lot_number' => $this->lot_number,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'mid_price' => $this->mid_price,
                'start_price' => $this->start_price,
                'buy_now_price' => $this->buy_now_price,
            ]
        );

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'mileage', $this->mileage])
            ->andFilterWhere(['like', 'engine', $this->engine])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'power', $this->power])
            ->andFilterWhere(['like', 'transmission', $this->transmission])
            ->andFilterWhere(['like', 'drive', $this->drive])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'registration_end', $this->registration_end])
            ->andFilterWhere(['like', 'vin', $this->vin])
            ->andFilterWhere(['like', 'auc_type', $this->auc_type])
            ->andFilterWhere(['like', 'photos_string', $this->photos_string]);

        return $dataProvider;
    }
}
