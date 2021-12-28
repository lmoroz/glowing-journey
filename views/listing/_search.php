<?php
/**
 * @var \app\models\LotSearchParamsList $searchParamsList
 * @var app\models\LotSearch $searchModel
 */
?>

<div class="col-12">
    <form class="auctions__filters">
        <select name="brand" id="brand" class="common-input auctions__filters__select">
			<option hidden value="">Бренд</option>
			<option value="">Любой</option>
            <?php foreach ($searchParamsList->getBrandList() as $key => $param) { ?>
				<option <?= $searchModel->brand === $key ? 'selected' : ''?> value="<?=$key?>"><?=$param?></option>
			<?php } ?>
        </select>
        <select name="model" id="model" class="common-input auctions__filters__select">
			<option hidden value="">Модель авто</option>
			<option value="">Любая</option>
            <?php foreach ($searchParamsList->getModelList() as $key => $param) { ?>
				<option <?= $searchModel->model === $key ? 'selected' : ''?> value="<?=$key?>"><?=$param?></option>
            <?php } ?>
        </select>
        <select name="is_active" id="is_active" class="common-input auctions__filters__select">
			<option hidden value="">Статус аукциона</option>
			<option value="">Любой</option>
            <?php foreach ($searchParamsList->getStatusList() as $key => $param) { ?>
				<option <?= (int)$searchModel->is_active === $key ? 'selected' : ''?> value="<?=$key?>"><?=$param?></option>
            <?php } ?>
        </select>
        <button class="common-btn black-btn auctions__filters__btn">Подобрать</button>
    </form>
</div>
