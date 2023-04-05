<?php

function getOrderStatusTitle($id){
    $sql = "SELECT `title` FROM `orders_statuses` WHERE id = '$id'";

    $result = mysqliQueryOneArray($sql);

    return $result['title'];
}