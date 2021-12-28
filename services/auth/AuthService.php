<?php


namespace app\services\auth;


use app\models\auth\AbstractAuthForm;
use app\models\User as UserModel;
use yii\web\User;

class AuthService implements AuthInterface
{
    public string $userClass = UserModel::class;

    private User $webUser;

    public function __construct(User $webUser)
    {
        $this->webUser = $webUser;
    }

    public function signup(AbstractAuthForm $form): void
    {
        /** @var UserModel $user */
        $user = $form->getUser();
        $user->setAttributes(
            [
                'code' => null,
                'status' => UserModel::STATUS_NOT_FINISHED_REGISTRATION
            ]
        );
        $user->save();
        $this->webUser->login($user);
    }

    public function signin(AbstractAuthForm $form): void
    {
        /** @var UserModel $user */
        $user = $form->getUser();
        $user->setAttributes(['code' => null,]);
        $user->save();
        $this->webUser->login($form->getUser());
    }
}