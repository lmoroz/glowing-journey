<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\AuthForm;
use app\widgets\Modal;
use app\widgets\WidgetFactory;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php
    $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    $this->head() ?>
</head>
<body>
<?php
$this->beginBody() ?>

<header id="header" class="header">

    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-md-2 col-3 d-flex align-items-center">
                <a class="header__logo" href="/">
                    <img src="/img/logo.svg" alt="Логотип">
                </a>
            </div>
            <div class="col-lg-6 col-md-12 order-lg-2 order-last header__main">
                <nav class="header__nav">
                    <ul class="header__menu">
                        <li class="header__menu__item">
                            <a href="/" class="header__menu__item__link">Главная</a>
                        </li>
                        <li class="header__menu__item">
                            <a href="<?= Url::to(['listing/index']) ?>" class="header__menu__item__link">Аукционы</a>
                        </li>

                    </ul>
                </nav>
                <div class="header__search">
                    <input class="form-control common-input header__search__input" type="text" name="search"
                           placeholder="Поиск...">
                    <button class="common-btn grey-btn header__search__btn">
                        <img src="/img/search.svg" alt="Поиск" class="header__search__btn__img">
                    </button>
                    <div class="header__search__close"></div>
                </div>
            </div>
            <div class="col-lg-5 col-md-10 col-9 order-lg-last order-2 header__settings-wrap">
                <ul class="header__settings">
                    <li class="header__settings__item">
                        <span class="header__settings__item__text">11:13 MSK</span>
                        <svg class="header__settings__item__arrow" width="10" height="7" viewBox="0 0 10 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 1L5 5L1 1" stroke="#5C5C5C" stroke-width="2"/>
                        </svg>
                        <ul class="header__submenu header__submenu-time">
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">ST</span>
                                <span class="header__submenu__item__link">UTC -11</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">HAST</span>
                                <span class="header__submenu__item__link">UTC -10</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">AKT</span>
                                <span class="header__submenu__item__link">UTC -9</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">ST</span>
                                <span class="header__submenu__item__link">UTC -8</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">HAST</span>
                                <span class="header__submenu__item__link">UTC -7</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">ST</span>
                                <span class="header__submenu__item__link">UTC -6</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">HAST</span>
                                <span class="header__submenu__item__link">UTC -5</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">AKT</span>
                                <span class="header__submenu__item__link">UTC -4</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">ST</span>
                                <span class="header__submenu__item__link">UTC -3</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">HAST</span>
                                <span class="header__submenu__item__link">UTC -2</span>
                            </li>
                            <li class="header__submenu__item header__submenu__item-time">
                                <span class="header__submenu__item__link">HAST</span>
                                <span class="header__submenu__item__link">UTC -1</span>
                            </li>
                        </ul>
                    </li>
                    <li class="header__settings__item">
                        <img class="header__settings__item__flag" src="/img/flags/russia.svg" alt="Российский флаг">
                        <span class="header__settings__item__text">Москва</span>
                        <svg class="header__settings__item__arrow" width="10" height="7" viewBox="0 0 10 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 1L5 5L1 1" stroke="#5C5C5C" stroke-width="2"/>
                        </svg>
                        <div class="header__submenu header__submenu-city">
                            <div class="header__submenu__country">
                                <div class="header__submenu__country__item header__submenu__country__item-active">
                                    <img class="header__settings__item__flag" src="/img/flags/russia.svg"
                                         alt="Российский флаг">
                                    <span class="header__submenu__item__link">Россия</span>
                                </div>
                                <div class="header__submenu__country__item">
                                    <img class="header__settings__item__flag" src="/img/flags/belarus.svg"
                                         alt="Белорусский флаг">
                                    <span class="header__submenu__item__link">Беларусь</span>
                                </div>
                                <div class="header__submenu__country__item">
                                    <img class="header__settings__item__flag" src="/img/flags/kazakhstan.svg"
                                         alt="Казахсткий флаг">
                                    <span class="header__submenu__item__link">Казахстан</span>
                                </div>
                            </div>
                            <input type="text" class="common-input header__submenu__input"
                                   placeholder="Введите название города">
                            <div class="header__submenu-city__content">
                                <span class="header__submenu-city__content__title">Марий Эл Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Йошкар-Ола</li>
                                    <li class="header__submenu-city__content__cities__item">Звенигово</li>
                                    <li class="header__submenu-city__content__cities__item">Волжск</li>
                                    <li class="header__submenu-city__content__cities__item">Козьмодемьянск</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Мордовия Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Саранск</li>
                                    <li class="header__submenu-city__content__cities__item">Краснослободск</li>
                                    <li class="header__submenu-city__content__cities__item">Инсар</li>
                                    <li class="header__submenu-city__content__cities__item">Рузаевка</li>
                                    <li class="header__submenu-city__content__cities__item">Ковылкино</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Марий Эл Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Йошкар-Ола</li>
                                    <li class="header__submenu-city__content__cities__item">Звенигово</li>
                                    <li class="header__submenu-city__content__cities__item">Волжск</li>
                                    <li class="header__submenu-city__content__cities__item">Козьмодемьянск</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Мордовия Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Саранск</li>
                                    <li class="header__submenu-city__content__cities__item">Краснослободск</li>
                                    <li class="header__submenu-city__content__cities__item">Инсар</li>
                                    <li class="header__submenu-city__content__cities__item">Рузаевка</li>
                                    <li class="header__submenu-city__content__cities__item">Ковылкино</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Марий Эл Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Йошкар-Ола</li>
                                    <li class="header__submenu-city__content__cities__item">Звенигово</li>
                                    <li class="header__submenu-city__content__cities__item">Волжск</li>
                                    <li class="header__submenu-city__content__cities__item">Козьмодемьянск</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Мордовия Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Саранск</li>
                                    <li class="header__submenu-city__content__cities__item">Краснослободск</li>
                                    <li class="header__submenu-city__content__cities__item">Инсар</li>
                                    <li class="header__submenu-city__content__cities__item">Рузаевка</li>
                                    <li class="header__submenu-city__content__cities__item">Ковылкино</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Марий Эл Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Йошкар-Ола</li>
                                    <li class="header__submenu-city__content__cities__item">Звенигово</li>
                                    <li class="header__submenu-city__content__cities__item">Волжск</li>
                                    <li class="header__submenu-city__content__cities__item">Козьмодемьянск</li>
                                </ul>
                                <span class="header__submenu-city__content__title">Мордовия Республика</span>
                                <ul class="header__submenu-city__content__cities">
                                    <li class="header__submenu-city__content__cities__item">Саранск</li>
                                    <li class="header__submenu-city__content__cities__item">Краснослободск</li>
                                    <li class="header__submenu-city__content__cities__item">Инсар</li>
                                    <li class="header__submenu-city__content__cities__item">Рузаевка</li>
                                    <li class="header__submenu-city__content__cities__item">Ковылкино</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="header__settings__item">
                        <span class="header__settings__item__text">Ru</span>
                        <svg class="header__settings__item__arrow" width="10" height="7" viewBox="0 0 10 7" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 1L5 5L1 1" stroke="#5C5C5C" stroke-width="2"/>
                        </svg>
                        <ul class="header__submenu">
                            <li class="header__submenu__item">
                                <img class="header__settings__item__flag" src="/img/flags/russia.svg"
                                     alt="Российский флаг">
                                <span class="header__submenu__item__link">Русский</span>
                            </li>
                            <li class="header__submenu__item">
                                <img class="header__settings__item__flag" src="/img/flags/belarus.svg"
                                     alt="Белорусский флаг">
                                <span class="header__submenu__item__link">Беларуская</span>
                            </li>
                            <li class="header__submenu__item">
                                <img class="header__settings__item__flag" src="/img/flags/kazakhstan.svg"
                                     alt="Казахсткий флаг">
                                <span class="header__submenu__item__link">Қазақ</span>
                            </li>
                            <li class="header__submenu__item">
                                <img class="header__settings__item__flag" src="/img/flags/uk.svg" alt="Английский флаг">
                                <span class="header__submenu__item__link">English</span>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="header__btns-wrap">
                    <?php
                    if (Yii::$app->getUser()->isGuest) { ?>
                        <button class="common-btn black-btn header__enter__btn" data-toggle="modal"
                                data-target="#enterModal">
                            Войти
                        </button>
                        <?php
                    } else { ?>
                        <div class="dropdown show">
                            <div class="header__auth" id="header__auth__dropdown">
                                <img class="header__auth__icon" src="/img/user.svg" alt="Пользователь">
                                <span class="header__auth__name"><?= Yii::$app->getUser()->getIdentity()->name ?></span>
                                <img class="header__auth__arrow" src="/img/arrows/arrow-down.svg" alt="Стрелка вниз">
                            </div>
                            <div class="dropdown-menu" aria-labelledby="header__auth__dropdown"
                                 x-placement="bottom-start">
								<a class="dropdown-item" href="<?= Url::to(['account/information']) ?>">Кабинет продавца</a>
								<a class="dropdown-item" href="<?= Url::to(['auth/logout']) ?>">Выйти</a>
                            </div>
                        </div>
                        <?php
                    } ?>
                    <button class="common-btn grey-btn header__search__btn-open">
                        <img src="/img/search.svg" alt="Поиск" class="header__search__btn__img">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?= Yii::$app->getUser()->isGuest ?
        Modal::widget(
            [
                'idElement' => 'enterModal',
                'title' => 'Вход на сайт',
                'content' => new WidgetFactory(AuthForm::class),
            ]
        ) :
        '' ?>

</header>
<?= $content ?>
<footer id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 mb-4 order-3 order-lg-1 footer__column__mobile-brd">
                <h4 class="footer__column-title">Контакты</h4>
                <div class="footer__column__content">
                    <div class="footer__column__content-address">
                        <div class="footer__column__content-address__wrap">
                            <img class="footer__column__icon" src="/img/footer-location.svg" alt="Иконка">
                            <span class="footer__column-text">Россия, г. Йошкар-Ола ул. Центральная, д. 73</span>
                        </div>
                    </div>
                    <div class="footer__column__content-address">
                        <div class="footer__column__content-address__wrap">
                            <img class="footer__column__icon" src="/img/footer-phone.svg" alt="Иконка">
                            <a href="tel:+7 999 99-999-99" class="footer__column-text">+7 999 99-999-99</a>
                        </div>
                        <div class="footer__socials">
                            <a href="#" class="footer__socials__link">
                                <img src="/img/socials/VK.svg" alt="VK">
                            </a>
                            <a href="#" class="footer__socials__link">
                                <img src="/img/socials/Facebook.svg" alt="Facebook">
                            </a>
                            <a href="#" class="footer__socials__link">
                                <img src="/img/socials/Instagram.svg" alt="Instagram">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4 order-2 order-lg-2 footer__column__mobile-brd">
                <h4 class="footer__column-title">Информация</h4>
                <div class="footer__column__content">
                    <a href="#" class="footer__column-text">FAQ</a>
                    <a href="#" class="footer__column-text">Новости</a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 order-3">
                <h4 class="footer__column-title footer__column-title-docs">Документы</h4>
                <div class="footer__column__content footer__column__content-docs">
                    <a href="#" class="footer__column-text">Договор оферты</a>
                    <a href="#" class="footer__column-text">Пользовательское соглашение</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
$this->endBody() ?>
</body>
</html>
<?php
$this->endPage() ?>
