<?php
?>
<header id="header" class="header">
    <div class="header-top">
        <div class="content content--lg">
            <div class="header-top--wrap">
                <div class="header-top--telephone">
                    <a href="tel:8800201714">8 (800) 200-17-14</a>
                </div>
                <div class="header-top--nav">
                    <nav>
                        <ul>
                            <li><a href="#" class="">Консультация</a></li>
                            <li><a href="#" class="">О нас</a></li>
                            <li class="has-drop">
                                <a href="#" class="">Услуги+</a>
                                <div class="header-top--drop">
                                    <a href="#">Индивидуальное проектирование</a>
                                    <a href="#">Адаптация фундамента</a>
                                    <a href="#">Разработка раздела игр</a>
                                    <a href="#">Посадка дома на участок</a>
                                    <a href="#">Разработка паспорта проекта</a>

                                </div>
                            </li>
                            <li><a href="#" class="">Сотрудничество</a></li>
                            <li><a href="#" class="">Коттеджные поселки России</a></li>
                            <li><a href="#" class="">Строители и магазины</a></li>
                            <li><a href="#" class="">Контакты</a></li>
                        </ul>
                    </nav>
                    <div class="header-top--search">
                        <div id="searchForm">
                            <form action="#">
                                <div class="fieldset">
                                    <input class="input" type="text" id="site-search">
                                </div>
                                <label class="label" for="site-search">
                                    <svg xmlns="http://www.w3.org/2000/svg">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"/>
                                    </svg>
                                </label>
                                <button class="submit" type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="content content--lg">
            <div class="header-main--wrap">
                <div class="header-main--logo">
                    <a href="/">
                        <img src="/svg/partials/logo.svg" alt="ARPLANS">
                    </a>
                </div>
                <div class="header-main--nav">
                    <?= \frontend\widgets\categories\Categories::widget(['viewName' => 'top']) ?>
                </div>
                <div class="header-main--stats">
                    <a href="#" class="stats stats-likes">
                        <span>34</span>
                        <i class="icon-likes">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-heart"/>
                            </svg>
                        </i>
                    </a>
                    <a href="#" class="stats stats-prods">
                        <span>10</span>
                        <i class="icon-basket">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-basket"/>
                            </svg>
                        </i>
                    </a>
                    <div class="burger desktop-hidden">
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="header-mobile desktop-hidden">
        <div class="bg"></div>
        <nav class="header-mobile--nav">
            <ul>
                <li class="show-more-parent">
                    <span class="show-more">Готовые проекты домов <span class="tick"></span></span>
                    <ul class="show-more-hidden">
                        <li><a href="#">Деревянные дома</a></li>
                        <li><a href="#">Каменные дома</a></li>
                        <li><a href="#">Каркасные дома</a></li>
                        <li><a href="#">Комбинированные дома</a></li>
                        <li><a href="#">Бани</a></li>
                        <li><a href="#">Индивидуальный проект</a></li>
                    </ul>
                </li>
                <li class="show-more-parent">
                    <span class="show-more">Услуги <span class="tick"></span></span>
                    <ul class="show-more-hidden">
                        <li><a href="#">Индивидуальное проектирование</a></li>
                        <li><a href="#">Адаптация фундамента</a></li>
                        <li><a href="#">Разработка раздела игр</a></li>
                        <li><a href="#">Посадка дома на участок</a></li>
                        <li><a href="#">Разработка паспорта проекта</a></li>
                    </ul>
                </li>
                <li>
                            <span>
                                <a href="#">Контакты</a>
                            </span>
                </li>
                <li>
                            <span>
                                <a href="#">Консультация</a>
                            </span>
                </li>
                <li>
                            <span>
                                <a href="#">О нас</a>
                            </span>
                </li>
                <li>
                            <span>
                                <a href="#">Сотрудничество</a>
                            </span>
                </li>
                <li>
                            <span>
                                <a href="#">Коттеджные поселки России</a>
                            </span>
                </li>
                <li>
                            <span>
                                <a href="#">Строители и магазины</a>
                            </span>
                </li>
            </ul>
        </nav>
    </div>
</header>
