<?php


/**
 * Выход пользователя из аккаунта
 *
 * @return void
 */
function logoutAction(){
    if(isset($_SESSION["user"])) unset($_SESSION["user"]);
    header("location: /");
}