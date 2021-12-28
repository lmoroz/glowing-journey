<?php


namespace app\services\auth;


use app\models\auth\AbstractAuthForm;

interface CodeSaver
{
    public function saveByAuthForm(AbstractAuthForm $form): void;

}