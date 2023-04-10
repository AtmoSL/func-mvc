<?php

/**
 * Получение многомерного массива дерева категорий
 *
 * @return array
 */
function getAllCategoriesForUl(){
    $sql = "SELECT * FROM `categories` WHERE `parent_id` = 0";

    $categories = mysqliQueryArray($sql);

    foreach ($categories as &$category){
        $children = getChildrenForCat($category['id']);
        if($children){
            $category['children'] = $children;
        }
    }

    return $categories;
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