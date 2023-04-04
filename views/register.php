<?php require_once 'layouts/head.php'; ?>

<section class="registration">
    <div class="container">
        <form class="registration__form form" action="/register/registration/" method="post">
            <div class="registration__form__element form__element">
                <label for="fullName">ФИО</label>
                <input type="text" name="fullName" id="fullName">
            </div>
            <div class="registration__form__element form__element">
                <label for="email">Почта</label>
                <input type="text" name="email" id="email">
            </div>
            <div class="registration__form__element form__element">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="registration__form__element form__element">
                <label for="password__repeat">Подтверждение пароля</label>
                <input type="password" name="passwordRepeat" id="passwordRepeat">
            </div>
            <div class="registration__form__element form__element">
                <button type="submit" class="registration__form__btn form__btn">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</section>

<?php require_once 'layouts/footer.php'; ?>