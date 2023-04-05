<?php

/**
 * Получение товаров из заказа по id заказа
 * @return array
 */
function getOrderProducts($id)
{
    $sql = "SELECT * FROM `orders_products` WHERE order_id = '$id'";

    $result = mysqliQueryArray($sql);

    return $result;
}
function createOrderProduct($order_id, $product_id, $count, $total_price){
    $sql = "INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `count`, `total_price`) VALUES (NULL, '$order_id', '$product_id', '$count', '$total_price')";
    mysqliSql($sql);
    return true;
}