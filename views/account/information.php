<?php

/**
 * @var User $model
 */

use app\models\User;
use app\models\UserPersonalInformation;
use yii\helpers\Url;

/** @var UserPersonalInformation $personalInformation */
$personalInformation = $model->personalInformation;

?>
<h1 class="common-big-title personal__title">Информация</h1>
<ul class="nav nav-tabs personal__nav" id="myTab" role="tablist">
	<li class="nav-item personal__nav__item">
		<a class="nav-link personal__nav__item__link active" id="general-tab" data-toggle="tab"
		   href="#" role="tab" aria-controls="general"
		   aria-selected="true">Общее</a>
	</li>
</ul>
<div class="tab-content personal__tab-content" id="myTabContent">
	<div class="tab-pane personal__tab-pane fade show active" id="general" role="tabpanel"
		 aria-labelledby="general-tab">
		<div class="personal-information-grid personal-information-grid-edit">
			<div class="personal-information-input-1">
				<label class="label">
					<span class="label__title">Фамилия</span>
					<span class="personal-information-value"><?= $personalInformation->surname ?></span>
				</label>
			</div>
			<div class="personal-information-input-2">
				<label class="label">
					<span class="label__title">Имя</span>
					<span class="personal-information-value"><?= $personalInformation->name ?></span>
				</label>
			</div>
			<div class="personal-information-input-3">
				<label class="label">
					<span class="label__title">Отчество</span>
					<span class="personal-information-value"><?= $personalInformation->patronymic ?></span>
				</label>
			</div>
			<div class="personal-information-input-4">
				<label class="label">
					<span class="label__title">Пол</span>
					<span class="personal-information-value">
						<?= UserPersonalInformation::getSexList()[$personalInformation->sex] ?? '-' ?>
					</span>
				</label>
			</div>
			<div class="personal-information-input-5">
				<label class="label">
					<span class="label__title">Дата рождения</span>
					<span class="personal-information-value"><?= $personalInformation->birthday ?></span>
				</label>
			</div>
			<div class="personal-information-input-6">
				<label class="label">
					<span class="label__title">Страна</span>
					<span class="personal-information-value"><?= $personalInformation->country ?></span>
				</label>
			</div>
			<div class="personal-information-input-7">
				<label class="label">
					<span class="label__title">Город</span>
					<span class="personal-information-value"><?= $personalInformation->city ?></span>
				</label>
			</div>
		</div>
	</div>
</div>
<div class="personal-information__btns">
	<a href="<?= Url::to('/account/information-edit') ?>" class="common-btn black-btn personal-information__btn">
		Редактировать
	</a>
</div>