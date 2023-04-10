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
function createProduct($product)
{
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
function updateProduct($product, $id)
{
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
function productDelete($id)
{
    $sql = "DELETE FROM products WHERE `products`.`id` = '$id'";

    mysqliSql($sql);

    return true;
}


function getProductPhotoPath($id)
{
    $sql = "SELECT `photo_path` FROM `products` WHERE id = '$id'";

    $result = mysqliQueryOneArray($sql);

    return $result['photo_path'];
}

/**
 * Валидация при создании товара
 * @return bool
 */
function validateProductForCreate()
{
    if (!isset($_POST)) {
        return false;
    }
    if (!isset($_POST["title"]) || !isset($_POST["category_id"]) || !isset($_POST["count"]) || !isset($_POST["price"])) {
        return false;
    }
    if (!is_numeric($_POST['count']) || ltrim($_POST["count"], "0") < 0) {
        return false;
    }
    if (!is_numeric($_POST['price']) || ltrim($_POST["price"], "0") < 0) {
        return false;
    }


    if (!isset($_FILES)) {
        return false;
    }

    //Загрузка и валидация файла
    $filename = basename($_FILES['photo_path']['name']);
    $file = $_FILES['photo_path'];
    $extension = strtolower(substr($filename, strrpos($filename, '.') + 1));

    if (!(($extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "png") && ($file["type"] == "image/jpeg" || $file["type"] == "image/gif" || $file["type"] == "image/png") &&
        ($file["size"] < 2120000))) {
        return false;
    }

    return true;
}

/**
 * Валидация товара для обновления
 *
 * @param $id
 * @return array|false
 */
function validateProductForUpdate($id){

    if (!isset($_POST)) {
        return false;
    }
    if (!isset($_POST["title"]) || !isset($_POST["category_id"]) || !isset($_POST["count"]) || !isset($_POST["price"])) {
        return false;
    }
    if (!is_numeric($_POST['count']) || ltrim($_POST["count"], "0") < 0) {
        return false;
    }
    if (!is_numeric($_POST['price']) || ltrim($_POST["price"], "0") < 0) {
        return false;
    }

    $product = getProductById($id);


    if (isset($_FILES['photo_path'])) {
        $filename = basename($_FILES['photo_path']['name']);
        $file = $_FILES['photo_path'];
        $extension = strtolower(substr($filename, strrpos($filename, '.') + 1));

        if (!(($extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "png") && ($file["type"] == "image/jpeg" || $file["type"] == "image/gif" || $file["type"] == "image/png") &&
            ($file["size"] < 2120000))) {
            return false;
        }
    }

    return $product;
}

/**
 * Сброс категорий товаров
 *
 * @param $categoryId
 * @return true
 */
function resetProductsCategory($categoryId){
    $sql = "UPDATE `products` SET `category_id` = '1' WHERE `category_id` = '$categoryId'";

    mysqliSql($sql);

    return true;
}