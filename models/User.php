<?php

namespace app\models;

use app\models\auth\AbstractAuthForm;
use app\services\auth\CodeSaver;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\filters\RateLimitInterface;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 *
 * @property int $id
 * @property string $phone
 * @property string $code
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $allowance
 * @property int $allowance_updated_at
 * @property-write mixed $password
 * @property-read null|string|mixed $authKey
 * @property-read \yii\db\ActiveQuery $personalInformation
 * @property int $updated_at
 */
class User extends ActiveRecord implements IdentityInterface, CodeSaver, RateLimitInterface
{
    public const STATUS_API = 999;
    public const STATUS_INACTIVE = 0;
    public const STATUS_NOT_FINISHED_REGISTRATION = 10;

    public $rateLimit = 1;
    public $rateLimitPerSec = 60;

    public function init(): void
    {
        $this->on(self::EVENT_AFTER_INSERT, [UserPersonalInformation::class, 'newUserHandler']);
        parent::init();
    }

    public static function tableName(): string
    {
        return '{{%user}}';
    }

    /**
     * @return string[]
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class
        ];
    }

    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            [['phone', 'code', 'name'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'code' => Yii::t('app', 'Code'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'role.item_name' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @param $phone
     * @return User|null
     */
    public static function findByPhone($phone): ?User
    {
        return static::findOne(['phone' => $phone]);
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_API]);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function getPersonalInformation(): ActiveQuery
    {
        return $this->hasOne(UserPersonalInformation::class, ['user_id' => 'id']);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function saveByAuthForm(AbstractAuthForm $form): void
    {
        $this->phone = $form->phone;
        $this->code = $form->code;
        if ($this->isNewRecord) {
            $this->status = self::STATUS_INACTIVE;
        }
        $this->save(false);
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord && !($this->status === self::STATUS_API)) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    public static function find(): UserQuery
    {
        return new UserQuery(static::class);
    }

    public function getRateLimit($request, $action): array
    {
        return [$this->rateLimit, $this->rateLimitPerSec];
    }

    public function loadAllowance($request, $action): array
    {
        return [$this->allowance, $this->allowance_updated_at];
    }

    public function saveAllowance($request, $action, $allowance, $timestamp): void
    {
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }
}
