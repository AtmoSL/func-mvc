<?php

/**
 * Получение многомерного массива дерева категорий
 *
 * @return array
 */
function getAllCategoriesForUl(){
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
function getCategory($id){
    $sql = "SELECT * FROM `categories` WHERE id = $id";

    $result = mysqliQueryOneArray($sql);

    return $result;
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

/**
 * Получение всех категорий
 *
 * @return array
 */
function getAllCategories(){
    $sql = "SELECT *
            FROM `categories`
            WHERE 1";

    $result = mysqliQueryArray($sql);

    return $result;
}