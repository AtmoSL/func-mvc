<?php
include "../models/UserModel.php";

function deleteAdminAction(){
    if ($_SESSION["user"]["role"] != 2) {
        echo json_encode("Недостаточно прав");
        die();
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $user = getUserById($id);

    if(!$user){
        echo json_encode("Пользователь не найден");
        die();
    }

    updateUserRole($user['id'], 1);

    echo json_encode("Администратор удалён");
    die();
}