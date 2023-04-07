<?php

include "OrdersProductModel.php";

/**
 * Создание заказа в БД
 *
 * @param $products
 * @return bool
 */
function createOrder($products, $cart)
{
    $userId = $_SESSION["user"]["id"];
    $orderTotalPrice = $cart['total_price'];

    $sql = "INSERT INTO `orders` (`id`, `user_id`, `status_id`, `total_price`) VALUES (NULL, '$userId', '1', '$orderTotalPrice')";

    $orderId = mysqliSql($sql);

    foreach ($products as $key => $product) {

        $productCount = $product["count"];
        $productTotalPrice = $product["total_price"];

        createOrderProduct($orderId, $key, $productCount, $productTotalPrice);
    }

    return $orderId;
}

/**
 * Получение заказа по id
 *
 * @param $id
 * @return array
 */
function getOrderById($id)
{
    $sql = "SELECT * FROM `orders` WHERE id = $id";

    $result = mysqliQueryOneArray($sql);

    return $result;
}

/**
 * Получение заказов пользователя
 *
 * @param $id
 * @return array
 */
function getOrderByUserId($id)
{
    $sql = "SELECT * FROM `orders` WHERE user_id = $id";

    $result = mysqliQueryArray($sql);

    return $result;
}

/**
 * Получение всех заказов
 *
 * @return array
 */
function getAllOrders(){
    $sql = "SELECT * FROM `orders` WHERE 1";

    $result = mysqliQueryArray($sql);

    return $result;
}

/**
 * Смена статуса заказа
 *
 * @param $orderId
 * @param $statusId
 * @return bool
 */
function changeOrderStatus($orderId, $statusId){

    $sql = "UPDATE `orders` SET `status_id` = '$statusId' WHERE `orders`.`id` = '$orderId'";

    mysqliSql($sql);

    return $statusId;

}

/**
 * Узнать id статуса у заказа
 * @param $id
 * @return mixed
 */
function getOrderStatusId($id){
    $sql = "SELECT `status_id` FROM `orders` WHERE `id` = '$id'";

    $result = mysqliQueryOneArray($sql);

    return $result['status_id'];
}