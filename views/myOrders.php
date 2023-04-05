<?php require_once 'layouts/head.php'; ?>

<section class="orders">
    <div class="container">
        <?php /** @var array $orders */
        if (count($orders) > 0 ){ ?>
        <div class="orders__title title">
            <h2>Мои заказы</h2>
        </div>
        <div class="orders__inner">
            <table class="orders__table">
                <thead>
                <tr>
                    <td>Дата и время оформления заказа</td>
                    <td>Номер заказа</td>
                    <td>Сумма заказа</td>
                    <td>Статус заказа</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>
                        <td><?= $order["created_at"] ?></td>
                        <td><?= $order["id"] ?></td>
                        <td><?= $order["total_price"] ?></td>
                        <td><?= $order["status_title"] ?></td>
                        <td><a href="/order/<?= $order["id"] ?>/">Перейти к заказу</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else {?>
            <div class="orders__message">
                Заказов нет.
            </div>
        <?php } ?>
</section>

<?php require_once 'layouts/footer.php'; ?>
