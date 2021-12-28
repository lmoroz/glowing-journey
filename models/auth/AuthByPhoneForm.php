<?php

namespace app\models\auth;

use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class AuthByPhoneForm extends AbstractAuthForm
{
    public const SCENARIO_CODE_REQUEST = 'code_request';

    public string $phone = '';
    public string $code = '';

    private ?User $_user;

    public function rules(): array
    {
        //todo проверка времени отправки кода. Должно пройти 60 сек
        return [
            [['phone'], 'required', 'on' => [self::SCENARIO_CODE_REQUEST]],
            [['phone'], 'validatePhone', 'on' => [self::SCENARIO_CODE_REQUEST]],
            [['phone', 'code'], 'required', 'on' => [self::SCENARIO_SIGNIN, self::SCENARIO_SIGNUP, self::SCENARIO_AUTH]],
            ['code', 'validateCode', 'on' => [self::SCENARIO_SIGNIN, self::SCENARIO_SIGNUP]],
        ];
    }

    public function validateCode($attribute, $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || ($user->code !== $this->code)) {
                $this->addError($attribute, 'Incorrect code.');
            }
        }
    }

    //todo
    public function validatePhone($attribute, $params)
    {

    }

    public function getUser(): ?User
    {
        if (!isset($this->_user)) {
            $this->_user = User::findByPhone($this->phone);
        }

        return $this->_user;
    }

    public function isNewUser(): bool
    {
        return $this->getUser()->status === User::STATUS_INACTIVE;
    }

    public function attributeLabels(): array
    {
        return (new User())->attributeLabels();
    }
}
