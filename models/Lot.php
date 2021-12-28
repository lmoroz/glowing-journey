<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property int $is_active
 * @property string $hash
 * @property string $url
 * @property string|null $brand
 * @property string|null $model
 * @property int|null $year
 * @property int|null $mileage
 * @property int|null $owners
 * @property string|null $engine
 * @property string|null $fuel
 * @property string|null $volume
 * @property string|null $power
 * @property string|null $transmission
 * @property string|null $drive
 * @property string|null $body
 * @property string|null $color
 * @property string|null $city
 * @property string|null $country
 * @property string|null $condition
 * @property int $lot_number
 * @property int|null $bid
 * @property int|null $start_date
 * @property int|null $end_date
 * @property string|null $registration_end
 * @property string|null $vin
 * @property string|null $comment
 * @property string|null $auc_type
 * @property int|null $mid_price
 * @property int|null $start_price
 * @property int|null $buy_now_price
 * @property string $photos_string
 * @property string|null $photo
 * @property-read string $nameYear
 * @property-read string $name
 * @property array|null $photos
 */
class Lot extends ActiveRecord
{
    public const STATUS_OPEN   = 1;
    public const STATUS_CLOSED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%lot}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['hash', 'url', 'brand', 'model', 'status'], 'required'],
            [['status'], 'default', 'value' => self::STATUS_OPEN],
            [['hash'], 'string', 'max' => 40],
            [['url'], 'string', 'max' => 2083],
            [
                [
                    'brand',
                    'model',
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
                    'registration_end',
                    'vin',
                    'comment',
                    'auc_type',
                    'photos_string'
                ],
                'string'
            ],
            [['year', 'mileage', 'owners', 'lot_number', 'bid', 'start_date', 'end_date', 'mid_price', 'buy_now_price', 'start_price'], 'integer'],
        ];
    }

    /**
     * splits and filters photos_string
     * @return array
     */
    public function getPhotos(): ?array
    {
        return array_filter(explode(',', $this->photos_string), [__CLASS__, 'isValidUrl']);
    }

    /**
     * get first photo
     * @return string
     */
    public function getPhoto(): ?string
    {
        return count($this->photos) ? $this->photos[0] : null;
    }

    /**
     * get lot name
     * @return string
     */
    public function getName(): string
    {
        return "$this->brand $this->model";
    }

    /**
     * get lot name, + year
     * @return string
     */
    public function getNameYear(): string
    {
        return "$this->brand $this->model, $this->year";
    }

    public function attributeLabels(): array
    {
        return [
            'url'              => Yii::t('app', 'Url'),
            'brand'            => Yii::t('app', 'Brand'),
            'model'            => Yii::t('app', 'Model'),
            'name'             => Yii::t('app', 'Name'),
            'year'             => Yii::t('app', 'Year'),
            'mileage'          => Yii::t('app', 'Mileage'),
            'owners'           => Yii::t('app', 'Owners'),
            'engine'           => Yii::t('app', 'Engine'),
            'fuel'             => Yii::t('app', 'Fuel'),
            'volume'           => Yii::t('app', 'Volume'),
            'power'            => Yii::t('app', 'Power'),
            'transmission'     => Yii::t('app', 'Transmission'),
            'drive'            => Yii::t('app', 'Drive'),
            'body'             => Yii::t('app', 'Body'),
            'color'            => Yii::t('app', 'Color'),
            'city'             => Yii::t('app', 'City'),
            'country'          => Yii::t('app', 'Country'),
            'distance'         => Yii::t('app', 'Distance'),
            'condition'        => Yii::t('app', 'Condition'),
            'lot_number'       => Yii::t('app', 'Lot Number'),
            'bid'              => Yii::t('app', 'Bid'),
            'start_date'       => Yii::t('app', 'Start Date'),
            'end_date'         => Yii::t('app', 'End Date'),
            'registration_end' => Yii::t('app', 'Registration End'),
            'vin'              => Yii::t('app', 'Vin'),
            'Comment'          => Yii::t('app', 'Comment'),
            'auc_type'         => Yii::t('app', 'Auc Type'),
            'mid_price'        => Yii::t('app', 'Mid Price'),
            'start_price'      => Yii::t('app', 'Start Price'),
            'buy_now_price'    => Yii::t('app', 'Buy-now Price'),
            'photo'            => Yii::t('app', 'Photo'),
            'photos'           => Yii::t('app', 'Photos'),
        ];
    }

    /**
     * Check if image url is valid full url to image
     *
     * @param string $str
     *
     * @return bool
     */
    private static function isValidUrl(string $str): bool
    {
        return (0 === stripos($str, "http") && !preg_match('~(youtube|youtu.be)~ui', $str));
    }

}
