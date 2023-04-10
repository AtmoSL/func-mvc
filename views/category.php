<?php require_once 'layouts/head.php'; ?>

    <!-- Каталог -->
    <section class="category">
        <div class="container">
            <div class="category__title title">
                <h2><?= /** @var array $category */
                    $category["title"] ?></h2>
            </div>

            <?php if(!empty($children)){ ?>

            <div class="category__children">
                <div class="category__children__title">
                    Дочерние категории:
                </div>
                <ul>
                    <?php foreach ($children as $catChild){?>
                        <li class="category__children__title">
                            <a href="/category/<?= $catChild["id"] ?>/"><?= $catChild["title"] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>

            <?php /** @var array $products */
            if(count($products) != 0){?>
            <div class="catalog__inner">

                <!-- Карточки товаров -->
                <?php /** @var array $products */
                foreach ($products as $product){ ?>

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
                        <div class="catalog__card__price">
                            <?= $product['price'] ?><span> руб.</span>
                        </div>
                        <div class="catalog__card__button" id="<?= $product['id'] ?>">В корзину</div>
                    </div>
                </div>

                <?php } ?>

            </div>
            <?php }else{?>
                    <div class="catalog__not-exist">
                        Товаров не найдено
                    </div>
            <?php }?>
    </section>

<?php require_once 'layouts/footer.php'; ?>