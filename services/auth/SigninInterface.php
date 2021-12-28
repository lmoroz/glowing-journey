<?php


namespace app\services\auth;


use app\models\auth\AbstractAuthForm;

interface SigninInterface
{
    public function signin(AbstractAuthForm $form): void;
}