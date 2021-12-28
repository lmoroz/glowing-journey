<?php


namespace app\controllers;


use app\assets\account\EditInformationAsset;
use app\models\User;
use app\models\UserPersonalInformation;
use app\models\UserQuery;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\helpers\Url;
use yii\rest\Serializer;
use yii\web\Controller;
use yii\web\Response;
use yii\web\JsonParser;

class AccountController extends Controller
{
    public $layout = 'account';
    public $serializer = Serializer::class;

    public function init(): void
    {
        parent::init();
        $this->request->parsers = ['application/json' => JsonParser::class];
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['information', 'information-edit', 'information-save'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            [
                'class' => ContentNegotiator::class,
                'only' => ['information-save'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionInformation(): string
    {
        return $this->render('information', ['model' => $this->getUserQuery()->one()]);
    }

    public function actionInformationEdit(): string
    {
        $this->view->registerJsVar('config_apiPath', '/api');
        $this->view->registerJsVar('config_modelData', $this->getUserQuery()->asArray()->one());
        $this->view->registerJsVar('config_sexSelect', UserPersonalInformation::getSexList());
        EditInformationAsset::register($this->view);
        return $this->render('informationEdit');
    }

    public function actionInformationSave()
    {
        $model = User::find()->current()->one();
        $modelInfo = $model->getPersonalInformation()->one();
        $modelInfo->load(Yii::$app->request->post(), '');
        if (!$modelInfo->save()) {
            return $modelInfo;
        }

        $this->response->statusCode = 202;
        return Url::to(['account/information']);
    }

    private function getUserQuery(): UserQuery
    {
        return  User::find()
            ->with('personalInformation')
            ->select(['t.email', 't.id'])
            ->alias('t')
            ->current();
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