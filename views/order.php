<?php require_once 'layouts/head.php'; ?>

<section class="order">
    <div class="container">
        <div class="order__title title">
            <h2>Оформление заказа</h2>
        </div>
        <div class="order__inner">
            <div class="order__separator"></div>
            <?php /** @var array $orderProducts */
            foreach ($orderProducts as $orderProduct){ ?>
            <div class="order__card">
                <div class="order__card__img">
                    <img src="/img/products/<?= $orderProduct['photo_path'] ?>" alt="<?= $orderProduct['title'] ?>">
                </div>
                <div class="order__card__info">
                    <div class="order__card__title">
                        <?= $orderProduct['title'] ?>
                    </div>
                    <div class="order__card__category">
                        <a href="/category/<?= $orderProduct['category']['id'] ?>/"><?= $orderProduct['category']['title'] ?></a>
                    </div>
                    <div class="order__card__price">
                        <?= $orderProduct['price'] ?><span> руб.</span>
                    </div>
                </div>
            </div>
                <div class="order__separator"></div>
            <?php } ?>
        </div>

        <?php if(count($orderProducts)== 0){ ?>
            <div class="order__message">
                Корзина пуста
            </div>
        <?php } else{?>
        <a href="#" class="order__create__btn">Оформить заказ</a>
        <?php } ?>

    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>
