<?php


namespace app\services\auth;


use app\models\auth\AbstractAuthForm;

interface SignupInterface
{
    public function signup(AbstractAuthForm $form): void;
}