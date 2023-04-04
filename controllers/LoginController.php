<?php

include "../models/CategoryModel.php";
include "../models/UserModel.php";

/**
 * Вывод страницы с формой для входа
 *
 * @return void
 */
function indexAction()
{
    if (isset($_SESSION["user"])) {
        header("location: /");
    } else {
        $categories = getAllCategoriesForUl();

        render("login", compact("categories"));
    }
}

/**
 * Выход пользователя из аккаунта
 *
 * @return void
 */
function logoutAction()
{
    if (isset($_SESSION["user"])) unset($_SESSION["user"]);
    header("location: /");
}

function authAction()
{
    if (!isset($_POST)) header("location: /register/");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION["messages"] = [];

    //Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION["messages"][] = "Введите корректный email";
        header("location: /login/");
        return false;
    }

    $user = getUserByEmail($email);

    //Проверка наличия пользователя
    if(!$user){
        $_SESSION["messages"][] = "Пользователь не найден";
        header("location: /login/");
        return false;
    }
    //Проверка пароля
    if($user['password'] != md5($password)){
        $_SESSION["messages"][] = "Пароль не подходит";
        header("location: /login/");
        return false;
    }

    $_SESSION["user"] = [];
    $_SESSION["user"]["id"] = $user['id'];
    $_SESSION["user"]["role"] = $user["role_id"];

    header("location: /");
    return true;
}