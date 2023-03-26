<?php

/**
 * Получение многомерного массива дерева категорий
 *
 * @return array
 */
function takeAllCategoriesForUl(){
    $sql = "SELECT * FROM `categories` WHERE `parent_id` = 0";

    $rs = mysqli_query(DB_CONNECT, $sql);

    $result = [];
    while ($row = mysqli_fetch_assoc($rs)){
        $children = getChildrenForCat($row['id']);
        if($children){
            $row['children'] = $children;
        }
        $result[] = $row;
    }

    return $result;
}

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

/**
 * Получение дочерних категорий для основной
 *
 * @param $id
 * @return array
 */
function getChildrenForCat($id){
    $sql = "SELECT *
            FROM `categories`
            WHERE `parent_id` = '$id'";

    $result = mysqliQueryArray($sql);

    return $result;
}