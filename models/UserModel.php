<?php


function createUser($fullName, $email, $password)
{

    $sql = "INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `role_id`) VALUES (NULL, '$fullName', '$email', '$password', '1')";

    $userIsEmpty = mysqliRowCheck(compact('email'), "users");

    if ($userIsEmpty) return false;

    $userId = mysqliCreate($sql);

    return $userId;

}

function getUserByEmail($email)
{
    $userIsEmpty = mysqliRowCheck(compact('email'), "users");

    if (!$userIsEmpty) return false;

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

    $user = mysqliQueryOneArray($sql);

    return  $user;
}