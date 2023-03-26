<?php

/**
 * Получение категории по id
 *
 * @param $id
 * @return array
 */
function takeCategory($id){
    $sql = "SELECT * FROM `categories` WHERE id = $id";

    $result = mysqliQueryArray($sql);

    return $result[0];
}