<?php

include "OrdersProductModel.php";

/**
 * Создание заказа в БД
 *
 * @param $products
 * @return bool
 */
function createOrder($products)
{
    $userId = $_SESSION["user"]["id"];
    $orderTotalPrice = $_SESSION['cart']['total_price'];

    $sql = "INSERT INTO `orders` (`id`, `user_id`, `status_id`, `total_price`) VALUES (NULL, '$userId', '1', '$orderTotalPrice')";

    $orderId = mysqliCreate($sql);

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

