<?php require_once 'layouts/head.php'; ?>

<section class="users">
    <div class="container">
        <form class="users__form form" action="/users/addadmin/" method="post">
            <div class="users__form__element form__element">
                <label for="email">Почта</label>
                <input type="email" name="email" id="email">
            </div>
            <?php if (isset($_SESSION["messages"]) && count($_SESSION["messages"]) > 0) { ?>
                <div class="users__form__element form__element">
                    <div class="users__form__message form__message">
                        <ul>
                            <?php foreach ($_SESSION["messages"] as $msg) { ?>
                                <li><?= $msg ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php }
            unset($_SESSION["messages"]); ?>
            <div class="users__form__element form__element">
                <button type="submit" class="registration__form__btn form__btn">Сделать администратором</button>
            </div>
        </form>
        <table class = "users__admin__table">
            <thead>
            <tr>
                <td>
                    Администраторы
                </td>
            </tr>
            </thead>
            <tbody>
            <?php /** @var array $admins */
            foreach ($admins as $admin) { ?>
                <tr id = "adminRow-<?=$admin['id']?>">
                    <td>
                        <?= $admin['email'] ?>
                    </td>
                    <?php if($_SESSION["user"]["id"] != $admin["id"]) {?>
                    <td>
                        <div class="users__admin__delete__btn" id="<?= $admin['id']?>">
                            Удалить администратора
                        </div>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>
