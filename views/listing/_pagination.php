<?php

/**
 * @var app\models\LotSearch $searchModel
 * @var \yii\data\ActiveDataProvider $provider
 */

?>

<div class="col-12 d-flex justify-content-end">
    <?= yii\grid\GridView::widget(
        [
            'options' => ['tag' => false],
            'dataProvider' => $provider,
            'filterModel' => $searchModel,
            'layout' => '{pager}',
            'summary' => '',
            'pager' => [
                'class' => app\widgets\Pager::class,
                'hideOnSinglePage' => false,
                'disabledPageCssClass' => 'auctions__pagination__item',
                'prevPageCssClass' => 'auctions__pagination__arrow',
                'nextPageCssClass' => 'auctions__pagination__arrow',
                'pageCssClass' => 'auctions__pagination__item',
                'activePageCssClass' => 'auctions__pagination__item auctions__pagination__item-active',
                'prevPageLabel' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.6001 8L9.6001 12L13.6001 16" stroke="black" stroke-width="2"/></svg>',
                'nextPageLabel' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.3999 8L14.3999 12L10.3999 16" stroke="black" stroke-width="2"/></svg>',
                'options' => ['tag' => 'div', 'class' => 'auctions__pagination'],
                'linkContainerOptions' => []
            ],
        ]
    ) ?>
</div>