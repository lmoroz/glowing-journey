<?php

namespace app\models;

use DateTimeImmutable;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_personal_information}}".
 *
 * @property int $user_id
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $patronymic
 * @property int|null $sex
 * @property string|null $birthday
 * @property string|null $country
 * @property string|null $city
 *
 * @property User $user
 */
class UserPersonalInformation extends ActiveRecord
{
    public const SEX_MAN = 1;
    public const SEX_WOMAN = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%user_personal_information}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['sex'], 'default', 'value' => self::SEX_MAN],
            [['birthday'], 'safe'],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['name', 'surname', 'patronymic', 'country', 'city'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'patronymic' => Yii::t('app', 'Patronymic'),
            'sex' => Yii::t('app', 'Sex'),
            'birthday' => Yii::t('app', 'Birthday'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function newUserHandler($event): void
    {
        $userId = $event->sender->id;
        $model = new self();
        $model->user_id = $userId;
        $model->save(false);
    }

    public static function getSexList(): array
    {
        return [
            self::SEX_MAN => Yii::t('app', 'Man'),
            self::SEX_WOMAN => Yii::t('app', 'Woman'),
        ];
    }
}
