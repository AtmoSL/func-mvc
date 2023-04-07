<?php

/**
 * Получение всех товаров из БД
 *
 * @return array
 */
function getAllProducts()
{
    $sql = "SELECT * FROM `products`";

    $result = mysqliQueryArray($sql);

    return $result;
}


/**
 * Получение товаров с категориями
 *
 * @return array
 */
function getAllProductsWithCategories()
{
    $products = getAllProducts();

    foreach ($products as $key => $product) {
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
function getProductsByCategory($categoryId)
{
    $sql = "SELECT * FROM `products` WHERE `category_id` = $categoryId ORDER BY id DESC";

    $products = mysqliQueryArray($sql);

    foreach ($products as $key => $product) {
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
function getProductsByIds($ids = [])
{
    $ids_str = implode(',', $ids);
    $sql = "SELECT * FROM `products` WHERE id in ($ids_str)";

    $products = mysqliQueryArray($sql);

    foreach ($products as $key => $product) {
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
function getProductById($id)
{
    $sql = "SELECT * FROM `products` WHERE id = $id";

    $product = mysqliQueryOneArray($sql);

    if (!isset($product["id"])) return false;
    return $product;
}

/**
 * Получение количества товара по id
 *
 * @param $key
 * @return mixed
 */
function getProductCount($key)
{
    $sql = "SELECT `count` FROM `products` WHERE id = '$key'";

    $result = mysqliQueryOneArray($sql);

    return $result["count"];
}


function updateProductCount($id, $count)
{
    $sql = "UPDATE `products` SET `count` = '$count' WHERE `id` = '$id'";

    mysqliSql($sql);

    return true;
}

/**
 * Создание товара
 *
 * @param array $product
 * @return bool
 */
function createProduct($product){
    extract($product);

    $sql = "INSERT INTO `products` (`id`, `category_id`, `title`, `price`, `photo_path`, `count`) VALUES (NULL, '$category_id', '$title', '$price', '$photo_path', '$count')";

    mysqliSql($sql);

    return true;
}

/**
 * Изменение товара
 *
 * @param $product
 * @param $id
 * @return bool
 */
function updateProduct($product, $id){
    extract($product);
    $sql = "UPDATE `products` SET 
                      `category_id` = '$category_id', 
                      `title` = '$title', 
                      `price` = '$price', 
                      `photo_path` = '$photo_path', 
                      `count` = '$count' 
                  WHERE `products`.`id` = '$id'";

    $result = mysqliSql($sql);

    return $result;
}

/**
 * Удаление товара
 *
 * @param $id
 * @return bool
 */
function productDelete($id){
    $sql = "DELETE FROM products WHERE `products`.`id` = '$id'";

    mysqliSql($sql);

    return true;
}


function getProductPhotoPath($id){
    $sql = "SELECT `photo_path` FROM `products` WHERE id = '$id'";

    $result = mysqliQueryOneArray($sql);

    return $result['photo_path'];
}