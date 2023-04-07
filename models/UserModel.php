<?php


function createUser($fullName, $email, $password)
{

    $sql = "INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role_id`) VALUES (NULL, '$fullName', '$email', '$password', '1')";

    $userIsEmpty = mysqliRowCheck(compact('email'), "users");

    if ($userIsEmpty) return false;

    $userId = mysqliSql($sql);

    return $userId;

}

/**
 * Получение пользователя по email
 *
 * @param $email
 * @return array|false
 */
function getUserByEmail($email)
{
    $userIsEmpty = mysqliRowCheck(compact('email'), "users");

    if (!$userIsEmpty) return false;

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

    $user = mysqliQueryOneArray($sql);

    return  $user;
}

function getUserNameAndEmail($id){
    $sql = "SELECT `fullname`, `email` FROM `users` WHERE `id` = '$id'";

    $result = mysqliQueryOneArray($sql);

    return  $result;
}

/**
 * Смена роли пользователя
 *
 * @param $user_id
 * @param $role_id
 * @return true
 */
function updateUserRole($user_id, $role_id){
    $sql = "UPDATE `users` SET `role_id` = '$role_id' WHERE `users`.`id` = '$user_id'";

    mysqliSql($sql);

    return true;
}

/**
 * Получение списка всех администраторов
 *
 * @return array
 */
function getAllAdmins(){
    $sql = "SELECT `id`, `email` FROM `users` WHERE `role_id` = '2' ";

    $result = mysqliQueryArray($sql);

    return $result;
}