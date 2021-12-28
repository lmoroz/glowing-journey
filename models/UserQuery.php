<?php


namespace app\models;


use Yii;
use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function current(): UserQuery
    {
        return $this->andWhere(['id' => Yii::$app->user->getId()]);
    }
}