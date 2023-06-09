<?php require_once 'layouts/head.php'; ?>

    <!-- Каталог -->
    <section class="catalog">
        <div class="container">
            <div class="catalog__title title">
                <h2>Каталог</h2>
            </div>
            <div class="catalog__inner">

                <!-- Карточки товаров -->
                <?php /** @var array $products */
                foreach ($products as $product) { ?>

                    <div class="catalog__card">
                        <div class="catalog__card__inner">
                            <div class="catalog__card__image">
                                <img src="/img/products/<?= $product['photo_path'] ?>" alt="<?= $product['title'] ?>">
                            </div>
                            <div class="catalog__card__title">
                                <?= $product['title'] ?>
                            </div>
                            <div class="catalog__card__category">
                                <a href="/category/<?= $product['category']['id'] ?>/"><?= $product['category']['title'] ?></a>
                            </div>
                            <?php if ($product['count'] > 0) { ?>
                                <div class="catalog__card__count">
                                    В наличии: <?= $product['count'] ?> шт.
                                </div>
                                <div class="catalog__card__price">
                                    <?= $product['price'] ?><span> руб.</span>
                                </div>
                                <div class="catalog__card__button" id="<?= $product['id'] ?>">В корзину</div>
                            <?php } else {?>
                            <div class="catalog__card__ended">
                                Нет в наличии
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                <?php } ?>

            </div>
    </section>

<?php require_once 'layouts/footer.php'; ?>