<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>

<div class="wrapper">
    <!-- Панель навигации -->
    <header class="header">
        <div class="container">
            <nav class="header__navigation">
                <div class="header__navigation__logo">
                    <a href="/">
                        <h1>Mvc-func</h1>
                    </a>
                </div>
                <ul class="header__navigation__list">
                    <li class="header__navigation__list__item">
                        <a href="#">Категории v</a>

                        <ul>
                            <?php /** @var array $categories */
                            foreach ($categories as $categoryItem) { ?>
                                <li>
                                    <a href="/category/<?= $categoryItem['id'] ?>/"><?= $categoryItem["title"] ?></a>
                                    <?php if (isset($categoryItem["children"])) { ?> >
                                        <ul>
                                            <?php foreach ($categoryItem["children"] as $child) { ?>
                                                <li>
                                                    <a href="/category/<?= $child['id'] ?>/"><?= $child["title"] ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>

                    </li>


                    <li class="header__navigation__list__item">
                        <a href="/">Каталог</a>
                    </li>
                    <li class="header__navigation__list__item">
                        <a href="/cart/"><span id="#cartCounter">
                                <?php if (isset($_SESSION['cart']['count']) && $_SESSION['cart']['count'] > 0) { ?>
                                    (<?= $_SESSION['cart']['count'] ?>)<?php } ?></span>
                            Корзина</a>
                    </li>
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li class="header__navigation__list__item">
                            <a href="/login/">
                                Вход</a>
                        </li>
                        <li class="header__navigation__list__item">
                            <a href="/register/">
                                Регистрация</a>
                        </li>
                    <?php } else {
                        if ($_SESSION["user"]["role"] == 2) { ?>
                                <li class="header__navigation__list__item">
                                    Админка v
                                    <ul>
                                        <li >
                                            <a href="/order/all/">
                                                Все заказы</a>
                                        </li>
                                        <li >
                                            <a href="/products/">
                                                Управление товарами</a>
                                        </li>
                                        <li>
                                            <a href="/users/">
                                                Права пользователей
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/categoryadmin/">
                                                Управление категориями
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                        <?php } else { ?>
                            <li class="header__navigation__list__item">
                                <a href="/order/myorders/">
                                    Мои заказы</a>
                            </li>
                        <?php } ?>

                        <li class="header__navigation__list__item">
                            <a href="/login/logout/">
                                Выход</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main">
