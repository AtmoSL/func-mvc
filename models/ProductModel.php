<?php

/**
 * Получение всех товаров из БД
 *
 * @return array
 */
function takeAllProducts(){
    $sql = "SELECT * FROM `products`";

    $result = mysqliQueryArray($sql);

    return $result;
}


/**
 * Получение товаров с категориями
 *
 * @return array
 */
function takeAllProductsWithCategories(){
    $products = takeAllProducts();

    foreach ($products as $key => $product){
        $products[$key]["category"] = takeCategory($product["category_id"]);
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
        $products[$key]["category"] = takeCategory($product["category_id"]);
    }

    return $products;
}