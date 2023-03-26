<?php

include "CategoryModel.php";
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