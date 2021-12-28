<?php

use yii\helpers\Url;

?>

<div id="informationApp">
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
			<div class="personal-information-grid">
				<div class="personal-information-input-1">
					<label for="surname" class="label">
						<span class="label__title">Фамилия</span>
						<input
								class="form-control common-input label__input"
								id="surname"
								type="text"
								v-model="personalInformation.surname"
								placeholder="Иванов">
					</label>
				</div>
				<div class="personal-information-input-2">
					<label for="name" class="label">
						<span class="label__title">Имя</span>
						<input
								class="form-control common-input label__input"
								id="name"
								type="text"
								v-model="personalInformation.name"
								placeholder="Иван">
					</label>
				</div>
				<div class="personal-information-input-3">
					<label for="patronymic" class="label">
						<span class="label__title">Отчество</span>
						<input class="form-control common-input label__input" id="patronymic" type="text"
							   v-model="personalInformation.patronymic"
							   placeholder="Иванович">
					</label>
				</div>
				<div class="personal-information-input-4">
					<label for="sex" class="label">
						<span class="label__title">Пол</span>
						<select class="form-control common-input label__input" id="sex"
								>
							<option v-for="sexItem, sexKey in lists.sex" :value="sexKey">{{sexItem}}</option>
						</select>
					</label>
				</div>
				<div class="personal-information-input-5">
					<label for="birthday" class="label">
						<span class="label__title">Дата рождения</span>
						<input class="form-control common-input label__input" id="birthday" type="text"
							   v-model="personalInformation.birthday"
							   placeholder="ГГГГ-ММ-ДД">
					</label>
				</div>
				<div class="personal-information-input-6">
					<label for="country" class="label">
						<span class="label__title">Страна</span>
						<input class="form-control common-input label__input" id="country" type="text"
							   v-model="personalInformation.country"
							   placeholder="Россия">
					</label>
				</div>
				<div class="personal-information-input-7">
					<label for="city" class="label">
						<span class="label__title">Город</span>
						<input class="form-control common-input label__input" id="city" type="text"
							   v-model="personalInformation.city"
							   placeholder="Йошкар-Ола">
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="personal-information__btns">
		<button class="common-btn black-btn personal-information__btn" @click="save">Сохранить</button>
		<a href="<?= Url::to(['account/information']) ?>"
		   class="common-btn grey-btn personal-information__btn">Отменить</a>
	</div>
</div>