<?php

include "../models/OrderStatusModel.php";
include "../models/OrderModel.php";

function changeStatusAction(){
    if(!isset($_SESSION["user"])){
        echo json_encode("Что-то не так с юзером");
        die();
    }
    if($_SESSION["user"]["role"] != 2){
        echo json_encode("Юзер не админ");
        die();
    }
    if (!isset($_POST["status_id"]))
    {
        echo json_encode("Не пришёл статус");
        die();
    }

    $orderId = isset($_GET['id']) ? $_GET['id'] : null;
    $statusId = $_POST['status_id'];

    $isStatus = checkStatusId($statusId);
    if(!$isStatus) return false;

    $newStatusId = changeOrderStatus($orderId, $statusId);

    echo json_encode($newStatusId);
    die();
}