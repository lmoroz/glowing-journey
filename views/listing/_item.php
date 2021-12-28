<?php

use yii\helpers\Url;

/**
 * @var Array $model
 */

?>

	<div class="auctions__list__item">
		<a href="<?= URL::to(['listing/auction-open', 'id' => $model['id']]) ?>">
			<img src="<?= $model['photo'] ?>" alt="Картинка" width="160" height="120">
		</a>
		<div class="auctions__list__item__text">
			<a href="<?= URL::to(['listing/auction-open', 'id' => $model['id']]) ?>">
				<h3 class="auctions__list__item__name"><?= $model['name'] ?> <?= $model['year'] ?></h3>
			</a>
			<span class="auctions__list__item__address">г. <?= $model['city'] ?></span>
			<span class="auctions__list__item__time">До завершения: <?= $model['end_date'] ?></span>
		</div>
		<button class="common-btn black-btn auctions__list__item__btn" data-toggle="modal" data-target="#rateModal">
			Сделать ставку
		</button>
		<div class="auctions__list__item__status">
			<span class="auctions__list__item__col-title">Статус</span>
			<span class="auctions__list__item__col-value">Открыт</span>
		</div>
		<div class="auctions__list__item__rate">
			<span class="auctions__list__item__col-title">Текущая ставка</span>
			<span class="auctions__list__item__col-value"><?= number_format($model['bid'], 2, ',', ' ') ?>₽</span>
		</div>
		<div class="auctions__list__item__your-rate">
			<span class="auctions__list__item__col-title">Ваша ставка</span>
			<input class="auctions__list__item__col-value" value="₽"/>
		</div>
		<div class="auctions__list__item__btns">
			<button class="auctions__list__item__icon-btn" data-toggle="modal"
					data-target="#notificationModal">
				<img src="/img/auctions/icons/notification.svg" alt="Уведомления" data-toggle="tooltip"
					 data-placement="top" title="Включить уведомления">
			</button>
			<button class="auctions__list__item__icon-btn auctions__list__item__icon-btn-check">
				<img src="/img/auctions/icons/check.svg" alt="Галочка" data-toggle="tooltip" data-placement="top"
					 title="Выделить">
			</button>
		</div>
	</div>

<?php

