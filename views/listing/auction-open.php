<?php

/**
  * @var Array $model
  */
use yii\helpers\Url;

?>

<section class="lot auction" id="auction">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="common-big-title auction__title">Информация об авто</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-12 mb-4">
        <div class="lot__image">
          <img class="popular__slide__img" src="<?=$model['photo']?>" alt="<?=\Yii::t('app', 'Фото');?> №1">
          <div class="popular__slide__images__arrows">
            <div class="popular__slide__images__arrows__prev lot__image__prev">
              <img src="/img/arrows/image-slide-prev.svg" alt="Назад">
            </div>
            <div class="popular__slide__images__arrows__next lot__image__next">
              <img src="/img/arrows/image-slide-next.svg" alt="Вперед">
            </div>
          </div>
        </div>
        <div class="lot__images">
            <?php foreach ($model['photos'] as $id=>$img) { ?>
          <img class="lot__images__img" src="<?=$img?>" alt="<?=\Yii::t('app', 'Фото');?> №<?=($id+1)?>">
            <?php }


            if (count($model['photos']) > 5) { ?>

          <div class="lot__images__img-wrap">
              <img class="lot__images__img" src="<?=$model['photos'][5]?>" alt="<?=\Yii::t('app', 'Фото');?> №1">
          </div>

            <?php } ?>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <h1 class="common-small-title lot-title">
            <?=$model['name']?>, <?=$model['year']?>, г. <?=$model['city']?>
          <span class="lot__id">#<?=$model['lot_number']?></span>
        </h1>
        <ul class="lot__list">
          <li class="lot__list__item">
            <span class="lot__list__item__name">Средняя рыночная стоимость</span>
            <span class="lot__list__item__res text-right"><?=number_format($model['bid'],0,',',' ')?>₽</span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">Текущая ставка</span>
            <span class="lot__list__item__res text-right"><?=number_format($model['bid'],2,',',' ')?>₽</span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">До завершения торгов</span>
            <span class="lot__list__item__res text-right"><?=$model['end_date']?></span>
          </li>
        </ul>
        <div class="lot__btns">
          <button class="common-btn black-btn lot__btn" data-toggle="modal" data-target="#rateModal">
            Сделать ставку
          </button>
          <a href="<?=Url::to(['listing/lot','id'=>$model['id']])?>" class="common-btn grey-btn lot__btn">
            Подробнее
          </a>
          <button class="common-btn grey-btn auction__bookmarks">
            <svg width="18" height="27" viewBox="0 0 18 27" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.32667 18.0642L1 24.7367V1H17V24.7367L9.67333 18.0642L9 17.451L8.32667 18.0642Z"
                    stroke="#5C5C5C" stroke-width="2"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <h2 class="common-big-title auction__title">Условия аукциона</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-6 mb-lg-0">
        <ul class="lot__list auction__list auction__list-brd">
          <li class="lot__list__item">
            <span class="lot__list__item__name">Тип аукциона</span>
            <span class="lot__list__item__res text-right">Открытый</span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">Начало аукциона</span>
            <span class="lot__list__item__res text-right"><?=$model['end_date']?></span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">Конец аукциона</span>
            <span class="lot__list__item__res text-right"><?=$model['end_date']?></span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">Начальная ставка</span>
            <span class="lot__list__item__res text-right"><?=number_format($model['bid'],2,',',' ')?>₽</span>
          </li>
        </ul>
      </div>
      <div class="col-12 col-lg-6">
        <ul class="lot__list auction__list">
          <li class="lot__list__item">
            <span class="lot__list__item__name">Шаг ставки</span>
            <span class="lot__list__item__res text-right">5 000₽</span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">Сумма выкупа</span>
            <span class="lot__list__item__res text-right"><?=number_format($model['bid'],2,',',' ')?>₽</span>
          </li>
          <li class="lot__list__item">
            <span class="lot__list__item__name">Средняя стоимость на рынке</span>
            <span class="lot__list__item__res text-right">967 000₽</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="modal modal-lot" id="rateModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <h4 class="modal-title">Сделайте ставку</h4>
      <span class="modal-lot__name mb-4"><?=$model['name']?> <?=$model['year']?></span>
      <div class="row">
        <div class="col-12 col-lg-6 pl-3 mb-3 mb-lg-0">
          <ul class="lot__list">
            <li class="lot__list__item">
              <span class="lot__list__item__name">Текущая ставка</span>
              <span class="lot__list__item__res"><?=number_format($model['bid'],2,',',' ')?>₽</span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">До окончания</span>
              <span class="lot__list__item__res"><?=$model['end_date']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Моя ставка</span>
              <input type="number" min="<?=($model['bid']+5000)?>" placeholder="<?=number_format(($model['bid']+5000),2,',',' ')?>₽" class="common-input lot__list__input" >
            </li>
          </ul>
          <span class="modal-lot__sign">Ставка должна превысить <?=number_format($model['bid'],2,',',' ')?>₽ (шаг ставки = 5 000₽)</span>
        </div>
        <div class="col-12 col-lg-6 pl-3 pl-lg-5">
          <ul class="lot__list">
            <li class="lot__list__item">
              <span class="lot__list__item__name">Номер лота</span>
              <span class="lot__list__item__res">#<?=$model['lot_number']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Расположение</span>
              <span class="lot__list__item__res">г. <?=$model['city']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Местоположение ТС</span>
              <span class="lot__list__item__res">В филиале</span>
            </li>
          </ul>
        </div>
        <div class="col-12">
          <div class="lot__btns">
            <button class="common-btn grey-btn lot__btn" data-dismiss="modal">Отменить</button>
            <button class="common-btn black-btn lot__btn" data-dismiss="modal" data-toggle="modal"
                    data-target="#rateModal-2">Сделать ставку
            </button>
          </div>
        </div>
      </div>
      <button class="modal-close" data-dismiss="modal">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L7.53333 8L1 15M15 1L8.46667 8L15 15" stroke="white" stroke-width="2"/>
        </svg>
      </button>
    </div>
  </div>
</div>
<div class="modal modal-lot" id="rateModal-2" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <h4 class="modal-title">Подтверждение ставки</h4>
      <span class="modal-lot__name mb-3"><?=$model['name']?> <?=$model['year']?></span>
      <span class="modal-lot__sign mb-3">Перед тем как “Подтвердить”, проверьте свою ставку и информацию о лоте.</span>
      <div class="row">
        <div class="col-12 col-lg-6 pl-3 mb-3 mb-lg-0">
          <ul class="lot__list">
            <li class="lot__list__item">
              <span class="lot__list__item__name">Текущая ставка</span>
              <span class="lot__list__item__res"><?=number_format($model['bid'],2,',',' ')?>₽</span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">До окончания</span>
              <span class="lot__list__item__res"><?=$model['end_date']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Моя ставка</span>
              <span class="lot__list__item__res"><?=number_format($model['bid'],2,',',' ')?>₽</span>
            </li>
          </ul>
        </div>
        <div class="col-12 col-lg-6 pl-3 pl-lg-5">
          <ul class="lot__list">
            <li class="lot__list__item">
              <span class="lot__list__item__name">Номер лота</span>
              <span class="lot__list__item__res">#<?=$model['lot_number']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Расположение</span>
              <span class="lot__list__item__res">г. <?=$model['city']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Местоположение ТС</span>
              <span class="lot__list__item__res">В филиале</span>
            </li>
          </ul>
        </div>
        <div class="col-12">
          <div class="lot__btns">
            <button class="common-btn grey-btn lot__btn" data-dismiss="modal" data-toggle="modal"
                    data-target="#rateModal">Назад
            </button>
            <button class="common-btn black-btn lot__btn" data-dismiss="modal" data-toggle="modal"
                    data-target="#rateModal-3">Подтвердить
            </button>
          </div>
        </div>
      </div>
      <button class="modal-close" data-dismiss="modal">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L7.53333 8L1 15M15 1L8.46667 8L15 15" stroke="white" stroke-width="2"/>
        </svg>
      </button>
    </div>
  </div>
</div>
<div class="modal modal-lot" id="rateModal-3" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <h4 class="modal-title">Успешно!</h4>
      <span class="modal-lot__name mb-4"><?=$model['name']?> <?=$model['year']?></span>
      <div class="row">
        <div class="col-12 col-lg-6 pl-3 mb-3 mb-lg-0">
          <ul class="lot__list">
            <li class="lot__list__item">
              <span class="lot__list__item__name">Номер лота</span>
              <span class="lot__list__item__res">#<?=$model['lot_number']?></span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">Ваша ставка</span>
              <span class="lot__list__item__res"><?=number_format($model['bid'],2,',',' ')?>₽</span>
            </li>
            <li class="lot__list__item">
              <span class="lot__list__item__name">До окончания</span>
              <span class="lot__list__item__res"><?=$model['end_date']?></span>
            </li>
          </ul>
        </div>
        <div class="col-12">
          <div class="lot__btns">
            <button class="common-btn grey-btn lot__btn" data-dismiss="modal">Назад к лоту
            </button>
            <a href="<?=Url::to(['account/information/personal-bets'])?>" class="common-btn black-btn lot__btn">К моим ставкам
            </a>
          </div>
        </div>
      </div>
      <button class="modal-close" data-dismiss="modal">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 1L7.53333 8L1 15M15 1L8.46667 8L15 15" stroke="white" stroke-width="2"/>
        </svg>
      </button>
    </div>
  </div>
</div>
