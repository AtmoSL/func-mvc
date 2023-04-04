<?php require_once 'layouts/head.php'; ?>

<section class="login">
    <div class="container">
        <form class="login__form form" action="/login/auth/" method="post">
            <div class="login__form__element form__element">
                <label for="email">Почта</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="login__form__element form__element">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password">
            </div>
           <?php if(isset($_SESSION["messages"])){ ?>
            <div class="login__form__element form__element">
                <div class="login__form__message form__message">
                    <ul>
                        <?php foreach ($_SESSION["messages"] as $msg) {  ?>
                        <li><?= $msg ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php }  unset($_SESSION["messages"]); ?>
            <div class="login__form__element form__element">
                <button type="submit" class="registration__form__btn form__btn">Войти</button>
            </div>
        </form>
    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>
