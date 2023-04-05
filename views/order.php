<?php require_once 'layouts/head.php'; ?>

<section class="order">
    <div class="container">
        <div class="order__title title">
            <h2>Заказ №<?= /** @var array $order */
                $order["id"] ?></h2>
        </div>
        <div class="order__inner">

            <table class="order__table">
                <thead>
                <tr>
                    <td></td>
                    <td>Название</td>
                    <td>Категория</td>
                    <td>Цена за шт.</td>
                    <td>Цена за всё</td>
                    <td>Количество</td>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $products */
                foreach ($products as $product) { ?>
                <tr>
                    <td>
                        <img src="/img/products/<?= $product['photo_path'] ?>" alt="<?= $product['title'] ?>">
                    </td>
                    <td><?= $product['title'] ?></td>
                    <td><a href="/category/<?= $product['category']['id'] ?>/"><?= $product['category']['title'] ?></a></td>
                    <td><?= $product['price'] ?><span> руб.</span></td>
                    <td><?= $product['total_price'] ?><span> руб.</span></td>
                    <td><?= $product['count']; ?> шт.</td>
                </tr>
                <?php } ?>
                <tr>
                    <td>
                        Статус заказа:
                    </td>
                    <td  colspan="5">
                         <?= $order['status_title'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Итого:
                    </td>
                    <td  colspan="5">
                        <?= $order["total_price"] ?> руб.
                    </td>
                </tr>
                </tbody>
            </table>

    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>
