<?php

use app\models\LotSearchParamsList;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var int $pageSize
 * @var LotSearchParamsList $searchParamsList
 * @var View $this
 * @var int $sort
 */

?>
	<div class="col-12">
		<div class="auctions__sorts">
			<select name="quantity" id="quantity" class="auctions__sorts__select">
                <?php
                foreach ($searchParamsList->getSortQuantityList() as $quantity) { ?>
					<option value="<?= Url::current(['pageSize' => $quantity]) ?>"
                        <?= (($pageSize === $quantity) ? ' selected' : '') ?>>
						Позиций на странице <?= $quantity ?>
					</option>
                    <?php
                } ?>
			</select>
			<select name="sort" id="sort" class="auctions__sorts__select auctions__sorts__select-sort">
				<option hidden>Сортировать</option>
                <?php
                foreach ($searchParamsList->getSortList() as $key => $name) { ?>
					<option value="<?= Url::current(['sort' => $key]) ?>"
                        <?= (($key === $sort) ? ' selected' : '') ?>><?= $name ?></option>
                    <?php
                } ?>
			</select>

			<a href="<?= Url::to(['listing/index']) ?>" class="auctions__sorts__select">
				<span>Показать все</span>
			</a>
		</div>
	</div>

<?php

$this->registerJs(
    <<<END
$(function() {
      $('#quantity').on('change', function() {
        var url = $(this).val();
        if (url) {
          window.location = url;
        }
        return false;
      });
    });
END,

    View::POS_END,
    'quantity-handler'
);

$this->registerJs(
    <<<END
$(function() {
      $('#sort').on('change', function() {
        var url = $(this).val();
        if (url) {
          window.location = url;
        }
        return false;
      });
    });
END,

    View::POS_END,
    'sort-handler'
);