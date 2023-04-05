<?php

/**
 * Получение названия статуса заказа
 *
 * @param $id
 * @return mixed
 */
function getOrderStatusTitle($id){
    $sql = "SELECT `title` FROM `orders_statuses` WHERE id = '$id'";

    $result = mysqliQueryOneArray($sql);

    return $result['title'];
}

/**
 * Получение всех статусов
 *
 * @return array
 */
function getAllOrderStatuses(){
    $sql = "SELECT * FROM `orders_statuses` WHERE 1";

    $result = mysqliQueryArray($sql);

    return $result;
}

/**
 * Проверка существования статуса для заказа
 *
 * @param $id
 * @return bool
 */
function checkStatusId($id){

    $result = mysqliRowCheck(compact('id'), 'orders_statuses');

    return $result;
}