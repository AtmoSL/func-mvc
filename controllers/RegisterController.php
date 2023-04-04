<?php
include "../models/CategoryModel.php";
include "../models/UserModel.php";


/**
 * Вывод формы регистрации
 *
 * @return void
 */
function indexAction()
{
    if (isset($_SESSION["user"])){
        header("location: /");
    }else{
        $categories = getAllCategoriesForUl();
        render('register', compact('categories'));
    }
}


/**
 * Регистрация пользователя
 *
 * @return false|void
 */
function registrationAction()
{
    if (!isset($_POST)) header("location: /register/");
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

    //Валидация
    if ($password != $passwordRepeat) return false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

    $password = md5($password);

    $result = createUser($fullName, $email, $password);

    if ($result) {
        $_SESSION["user"] = [];
        $_SESSION["user"]["id"] = $result;
        $_SESSION["user"]["role"] = 1;

        header("location: /");
    } else {
        header("location: /register/");
    }


}