<?php

/**
 * Получение всех товаров из БД
 *
 * @return array
 */
function getAllProducts(){
    $sql = "SELECT * FROM `products`";

    $result = mysqliQueryArray($sql);

    return $result;
}


/**
 * Получение товаров с категориями
 *
 * @return array
 */
function getAllProductsWithCategories(){
    $products = getAllProducts();

    foreach ($products as $key => $product){
        $products[$key]["category"] = getCategory($product["category_id"]);
    }

    return $products;
}

/**
 * Получение всех товаров категории
 *
 * @param $categoryId
 * @return array
 */
function getProductsByCategory($categoryId){
    $sql = "SELECT * FROM `products` WHERE `category_id` = $categoryId ORDER BY id DESC";

    $products = mysqliQueryArray($sql);

    foreach ($products as $key => $product){
        $products[$key]["category"] = getCategory($product["category_id"]);
    }

    return $products;
}

/**
 * Получение массива товаров по id
 *
 * @param $ids
 * @return array
 */
function getProductsByIds($ids = []){
    $ids_str = implode(',', $ids);
    $sql = "SELECT * FROM `products` WHERE id in ($ids_str)";

    $products = mysqliQueryArray($sql);

    foreach ($products as $key => $product){
        $products[$key]["category"] = getCategory($product["category_id"]);
    }

    return $products;
}

/**
 * Получение товара по id
 *
 * @param $id
 * @return array|false
 */
function getProductById($id){
    $sql = "SELECT * FROM `products` WHERE id = $id";

    $product = mysqliQueryOneArray($sql);

    if (!isset($product["id"])) return false;
    return $product;

}