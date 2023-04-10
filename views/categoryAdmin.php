<?php require_once 'layouts/head.php'; ?>

    <section class="categoryadmin">
        <div class="container">
            <div class="categoryadmin__title title">
                <h2>Управление категориями</h2>
            </div>
            <div class="categoryadmin__inner">
                <table class="categoryadmin__table">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Название</td>
                        <td>Корневая категория</td>
                    </tr>
                    </thead>

                    <tbody>
                    <form action="/categoryadmin/create/" method="post">
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" name="title" id="title" value="">
                            </td>
                            <td>

                                <select class="categoryadmin__selector" name="parent_id">
                                    <?php /** @var array $allCategoriesParents */
                                    foreach ($allCategoriesParents as $categoryParent) { ?>
                                        <option value="<?= $categoryParent["id"] ?>"><?= $categoryParent["title"] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit">Создать</button>
                            </td>
                        </tr>
                    </form>
                    <?php /** @var array $allCategories */
                    foreach ($allCategories as $categoryItem) { ?>

                        <form action="/categoryadmin/delete/<?= $categoryItem["id"] ?>/" id="deleteForm-<?= $categoryItem["id"] ?>">
                        </form>
                        <form action="/categoryadmin/update/<?= $categoryItem["id"] ?>/" method="post">
                            <tr id="categoryRow-<?= $categoryItem["id"] ?>">

                                <td><?= $categoryItem["id"] ?></td>
                                <td>
                                    <input type="text" name="title" id="title" value="<?= $categoryItem['title'] ?>">
                                </td>
                                <td>

                                    <select class="categoryadmin__selector" name="parent_id" id="<?= $categoryItem["id"] ?>">
                                        <?php /** @var array $productCategories */
                                        foreach ($allCategoriesParents as $categoryParent) { ?>
                                            <option value="<?= $categoryParent["id"] ?>" <?= ($categoryParent["id"] == $categoryItem["parent_id"]) ? "selected" : "" ?>><?= $categoryParent["title"] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>

                                    <button class="categoryadmin__delete__btn" id="<?= $categoryItem["id"] ?>" form="deleteForm-<?= $categoryItem["id"] ?>">
                                        Удалить
                                    </button>
                                    <button type="submit">Изменить</button>
                                </td>

                            </tr>
                        </form>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php require_once 'layouts/footer.php'; ?>