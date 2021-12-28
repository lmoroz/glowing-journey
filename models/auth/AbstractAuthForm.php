<?php

namespace app\models\auth;

use app\models\User;
use yii\base\Model;

/**
 *
 * @property-read User|null $user
 */
abstract class AbstractAuthForm extends Model
{
    public const SCENARIO_SIGNIN = 'signin';
    public const SCENARIO_SIGNUP = 'signup';
    public const SCENARIO_AUTH = 'auth';

    abstract public function getUser(): ?User;
}
