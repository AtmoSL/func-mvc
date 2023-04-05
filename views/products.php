<?php require_once 'layouts/head.php'; ?>

    <section class="products">
        <div class="container">
            <div class="order__title title">
                <h2>Управление товарами</h2>
            </div>
            <div class="products__inner">
                <table class="products__table">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Фото</td>
                        <td>Название</td>
                        <td>Категория</td>
                        <td>Количество</td>
                        <td>Цена</td>
                    </tr>
                    </thead>

                    <tbody>
                    <form action="">
                        <tr>
                            <td></td>
                            <td>
                            </td>
                            <td>
                                <input type="text" name="title" id="title" value="">
                            </td>
                            <td>

                                <select class="products__selector" name="category_id" >
                                    <?php /** @var array $productCategories */
                                    foreach ($productCategories as $productCategory){ ?>
                                        <option value="<?= $productCategory["id"] ?>" ><?= $productCategory["title"] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="text" name="count" id="count" value=""></td>
                            <td><input type="text" name="price" id="price" value=""></td>
                            <td>
                                <button type="submit">Создать</button></td>
                        </tr>
                    </form>
                    <?php /** @var array $products */
                    foreach ($products as $product) { ?>
                        <form action="/products/update/" method="post">
                            <tr>

                                <td><?= $product["id"] ?></td>
                                <td>
                                    <img src="/img/products/<?= $product['photo_path'] ?>"
                                         alt="<?= $product['title'] ?>">
                                </td>
                                <td>
                                    <input type="text" name="title" id="title" value="<?= $product['title'] ?>">
                                </td>
                                <td>

                                    <select class="products__selector" name="category_id" id="<?= $product["id"] ?>">
                                        <?php /** @var array $productCategories */
                                        foreach ($productCategories as $productCategory){ ?>
                                            <option value="<?= $productCategory["id"] ?>" <?= ($productCategory["id"] == $product["category_id"]) ? "selected" : "" ?>><?= $productCategory["title"] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input type="text" name="count" id="count" value="<?= $product['count'] ?>"></td>
                                <td><input type="text" name="price" id="price" value="<?= $product['price'] ?>"></td>
                                <td>
                                    <button type="submit">Изменить</button></td>
                            </tr>
                        </form>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php require_once 'layouts/footer.php'; ?>