<?php

/**
 * @var LotSearch $searchModel
 * @var ActiveDataProvider $provider
 * @var LotSearchParamsList $searchParamsList
 * @var View $this
 * @var int $pageSize
 * @var int $sort
 */

use app\models\LotSearch;
use app\models\LotSearchParamsList;
use yii\data\ActiveDataProvider;
use yii\web\View;

?>
<section id="auctions" class="auctions">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 class="common-small-title auctions__title">
                    <?= Yii::t(
                        'app',
                        '{n, plural, =0{Нет открытых аукционов} =1{Найден один открытый аукцион} one{Найден # открытый аукцион} few{Всего найден # открытый аукцион} many{Всего найдено # открытых аукционов} other{Всего найдено # открытых аукционов}}',
                        ['n' => $provider->getTotalCount()]
                    ); ?>
				</h1>
			</div>
		</div>
		<div class="row">
            <?= $this->render('_search', compact('searchModel', 'searchParamsList')) ?>
		</div>
		<div class="row">
            <?= $this->render('_sort', compact('pageSize', 'searchParamsList', 'sort')) ?>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="auctions__list">
                    <?php
                    foreach ($provider->getModels() as $model) {
                        echo $this->render('_item', compact('model'));
                    } ?>
				</div>
			</div>
		</div>
		<div class="row">
            <?= $this->render('_pagination', compact('provider', 'searchModel')) ?>
		</div>
	</div>
</section>

<?= $this->render('_dialog') ?>
