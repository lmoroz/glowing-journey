<?php

namespace app\controllers;

use app\models\Lot;
use app\models\LotSearch;
use app\models\LotSearchParamsList;
use Yii;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;
use yii\web\Session;

/**
 *
 * @property-read array $params
 */
class ListingController extends Controller
{

    private Session $session;

    public function __construct($id, $module, Session $session, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new LotSearch();
        $provider = $searchModel->search($this->getParams());

        return $this->render(
            'index',
            [
                'provider' => $provider,
                'pageSize' => $provider->pagination->pageSize,
                'searchModel' => $searchModel,
                'searchParamsList' => Yii::$container->get(LotSearchParamsList::class),
                'sort' => $searchModel->sort,
            ]
        );
    }

    public function actionAuctionOpen(int $id): string
    {
        $model = Lot::find()->where(['id' => $id])->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }
        return $this->render('auction-open', ['model' => $model]);
    }

    public function actionLot(int $id): string
    {
        $model = Lot::find()->where(['id' => $id])->one();
        if ($model === null) {
            throw new NotFoundHttpException();
        }
        return $this->render('lot', ['model' => $model]);
    }

    private function getParams(): array
    {
        $safeSessionParams = ['pageSize', 'sort'];
        $this->updateSessionParams($safeSessionParams);
        $params = $this->request->queryParams;
        foreach ($safeSessionParams as $key) {
            if ($value = $this->session->get($key)) {
                $params[$key] = $value;
            }
        }
        return $params;
    }

    private function updateSessionParams(array $params): void
    {
        foreach ($params as $param) {
            $paramValue = $this->session->get($param);
            if ($paramValue === null || $paramValue !== $this->request->get($param)) {
                $this->session->set($param, $this->request->get($param));
            }
        }
    }

}
