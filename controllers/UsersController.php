<?php
include "../models/CategoryModel.php";
include "../models/UserModel.php";

/**
 * Вывод страницы управления пользователями
 *
 * @return void
 */
function indexAction(){
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        die();
    }

    $categories = getAllCategoriesForUl();

    render("users", compact( "categories"));
}

/**
 * Функция добавления администратора
 *
 * @return bool
 */
function addAdminAction(){

    $_SESSION["messages"] = [];
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        die();
    }
    if (!isset($_POST)){
        $_SESSION["messages"][] = "Нет данных";
        header("location: /users/");
    };

    $email = $_POST['email'];

    //Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION["messages"][] = "Введите корректный email";
        header("location: /users/");
        return false;
    }

    $user = getUserByEmail($email);

    //Проверка наличия пользователя
    if(!$user){
        $_SESSION["messages"][] = "Пользователь не найден";
        header("location: /login/");
        return false;
    }

    updateUserRole($user['id'], 2);
    $_SESSION["messages"][] = "Администратор добавлен";

    header("location: /users/");
    return true;
}