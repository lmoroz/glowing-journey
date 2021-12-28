<?php

namespace app\api\v1\controllers;

use app\api\v1\models\Request;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use yii\rest\Serializer;
use yii\web\Response;

/**
 * RESTParserController implements the CRUD actions for Request model.
 */
class RestParserController extends ActiveController
{
    public $modelClass = Request::class;
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'requests',
    ];

    public function behaviors(): array
    {
        $behaviors = ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => ContentNegotiator::class,
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON,
                        'application/xml' => Response::FORMAT_XML,
                    ],
                ],
            ]
        );

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBearerAuth::class,
                QueryParamAuth::class,
            ],
        ];

        unset($behaviors['rateLimiter']);

        return $behaviors;
    }

    public function actions(): array
    {
        return [];
    }

    public function actionCreate(): Request
    {
        Yii::$app->getResponse()->setStatusCode(201);
        return $this->processRequest(Request::TYPE_ADD);
    }

    public function actionUpdate(): Request
    {
        Yii::$app->getResponse()->setStatusCode(202);
        return $this->processRequest(Request::TYPE_UPDATE);
    }

    protected function processRequest(string $type): Request
    {
        /** @var Request $model */
        $model = new $this->modelClass;
        $model->type = $type;
        $model->raw = Yii::$app->request->rawBody;
        $model->save();
        return $model;
    }

}
