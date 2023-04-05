<?php require_once 'layouts/head.php'; ?>

<section class="orders">
    <div class="container">
        <?php /** @var array $orders */
        if (count($orders) > 0) { ?>
            <div class="orders__title title">
                <h2>Все заказы</h2>
            </div>
            <div class="orders__inner">
                <table class="orders__table">
                    <thead>
                    <tr>
                        <td>Дата и время оформления заказа</td>
                        <td>Номер заказа</td>
                        <td>Пользователь</td>
                        <td>Сумма заказа</td>
                        <td>Статус заказа</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?= $order["created_at"] ?></td>
                            <td><?= $order["id"] ?></td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Имя пользователя:</td>
                                        <td><?= $order["user"]["fullname"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Почта пользователя:</td>
                                        <td><?= $order["user"]["email"] ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?= $order["total_price"] ?></td>
                            <td>
                                <select name="status_id" id="orderStatusSelector-<?= $order["id"] ?>">
                                    <?php /** @var array $statuses */
                                    foreach ($statuses as $status){ ?>
                                    <option value="<?= $status["id"] ?>" <?= ($status["id"] == $order["status_id"]) ? "selected" : "" ?>><?= $status["title"] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><a href="/order/<?= $order["id"] ?>/">Перейти к заказу</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="orders__message">
                Заказов нет.
            </div>
        <?php } ?>
</section>

<?php require_once 'layouts/footer.php'; ?>
