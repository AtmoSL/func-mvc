<?php

include "../models/OrderStatusModel.php";
include "../models/OrderModel.php";
include "../models/ProductModel.php";


/**
 * Изменение статуса заказа
 *
 * @return false|void
 */
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


    $orderStatus = getOrderStatusId($orderId);


    if($orderStatus == 3){
        echo json_encode($statusId);
        die();
    }

    if ($statusId == 3){
        $orderProducts = getOrderProducts($orderId);

        foreach ($orderProducts as $orderProduct){
            $product = getProductById($orderProduct["product_id"]);

            $newCount = $product["count"] + $orderProduct["count"];

            updateProductCount($orderProduct["product_id"], $newCount);
        }
    }


    $isStatus = checkStatusId($statusId);
    if(!$isStatus){
        echo json_encode("Статус не найден");
        die();
    }
    $newStatusId = changeOrderStatus($orderId, $statusId);

    echo json_encode($newStatusId);
    die();
}