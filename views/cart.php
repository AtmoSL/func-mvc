<?php require_once 'layouts/head.php'; ?>

<section class="cart">
    <div class="container">
        <div class="cart__title title">
            <h2>Оформление заказа</h2>
        </div>
        <div class="cart__inner" id="cartInner">
            <div class="cart__separator"></div>
            <?php /** @var array $cartProducts */
            foreach ($cartProducts as $cartProduct) { ?>
                <div class="cart__card" id="cartCard-<?= $cartProduct['id'] ?>">
                    <div class="cart__card__img">
                        <img src="/img/products/<?= $cartProduct['photo_path'] ?>" alt="<?= $cartProduct['title'] ?>">
                    </div>
                    <div class="cart__card__info">
                        <div class="cart__card__title">
                            <?= $cartProduct['title'] ?>
                        </div>
                        <div class="cart__card__category">
                            <a href="/category/<?= $cartProduct['category']['id'] ?>/"><?= $cartProduct['category']['title'] ?></a>
                        </div>
                        <div class="cart__card__price" id = "productTotalPrice-<?= $cartProduct['id'] ?>">
                            <?= $cartProduct['total_price'] ?><span> руб.</span>
                        </div>
                    </div>
                    <div class="cart__card__actions">
                        <div class="cart__card__delete" id="<?= $cartProduct['id'] ?>">
                            Удалить
                        </div>
                        <div class="cart__card__count">
                            <div class="cart__card__count__minus" id="<?= $cartProduct['id'] ?>">—</div>
                            <div class="cart__card__count__text" id="productCountText-<?= $cartProduct['id'] ?>">
                                <?= $cartProduct['count']; ?> шт.
                            </div>
                            <div class="cart__card__count__plus" id="<?= $cartProduct['id'] ?>">+</div>
                        </div>
                    </div>
                </div>
                <div class="cart__separator" id="cartSeparator-<?=$cartProduct['id'] ?>"></div>
            <?php } ?>
        </div>

        <?php if (count($cartProducts) == 0) { ?>
            <div class="cart__message">
                Корзина пуста
            </div>
        <?php } else { ?>
                <div class="cart__total__price" id="cartTotalPriceParent">
                    Итого: <span id="cartTotalPrice"><?= /** @var integer $cartTotalPrice */
                        $cartTotalPrice ?></span> руб.
                </div>
            <a href="/order/create/" class="cart__create__btn" id="makeOrderButton">Оформить заказ</a>
        <?php } ?>

    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>
