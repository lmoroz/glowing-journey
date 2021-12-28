<?php


namespace app\controllers;


use app\models\auth\AuthByPhoneForm;
use app\models\User;
use app\services\auth\AuthInterface;
use app\services\auth\CodeService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\rest\Serializer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AuthController extends Controller
{
    public $serializer = Serializer::class;

    private AuthInterface $authService;

    public function __construct($id, $module, AuthInterface $authService, $config = [])
    {
        $this->authService = $authService;
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['send-code', 'auth'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['get'],
                    'auth' => ['post'],
                    'sendCode' => ['get'],
                ],
            ],
            [
                'class' => ContentNegotiator::class,
                'only' => ['send-code', 'auth'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'rateLimiter' => [
                'class' => RateLimiter::class,
                'only' => ['send-code'],
                'user' => static function($action) {
                    return User::findByPhone($action->controller->request->get('phone'));
                }
            ]
        ];
    }

    public function actionAuth()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AuthByPhoneForm(['scenario' => AuthByPhoneForm::SCENARIO_AUTH]);
        $model->load(Yii::$app->request->post(), '');
        if ($model->getUser() === null) {
            throw new NotFoundHttpException('User not found');
        }
        $isNewUser = $model->isNewUser();
        $model->scenario = $isNewUser ? AuthByPhoneForm::SCENARIO_SIGNUP : AuthByPhoneForm::SCENARIO_SIGNIN;
        if (!$model->validate()) {
            return $model;
        }
        $isNewUser ? $this->authService->signup($model) : $this->authService->signin($model);
        $this->response->statusCode = 202;
        return Url::to(['account/information-edit']);
    }

    public function actionSendCode(string $phone)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new AuthByPhoneForm(['scenario' => AuthByPhoneForm::SCENARIO_CODE_REQUEST]);
        $form->phone = $phone;
        if (!$form->validate()) {
            return $form;
        }
        $user = $form->getUser() ?? new User();
        $cont = Yii::$container->get(CodeService::class, [
            'codeSaver' => $user,
            'form' => $form,
        ]);
        $cont->run();
        $this->response->statusCode = 204;
        return $this->response;
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        return $this->serializeData($result);
    }

    protected function serializeData($data)
    {
        return Yii::createObject($this->serializer)->serialize($data);
    }

}