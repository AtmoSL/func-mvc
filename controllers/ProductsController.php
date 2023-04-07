<?php

include '../models/ProductModel.php';
include '../models/CategoryModel.php';

/**
 * Вывод страницы с товарами
 *
 * @return false|void
 */
function indexAction()
{
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        return false;
    }

    $products = getAllProducts();
    $productCategories = getAllCategories();

    $categories = getAllCategoriesForUl();

    render("products", compact("products", "categories", "productCategories"));
}


/**
 * Создание нового товара
 *
 * @return true|void
 */
function createAction()
{
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        die();
    }

    if (!isset($_POST)) {
        header("location: /products/");
        die();
    }
    if (!isset($_POST["title"]) || !isset($_POST["category_id"]) || !isset($_POST["count"]) || !isset($_POST["price"])) {
        header("location: /products/");
        die();
    }
    if (ltrim($_POST["count"], "0") < 0) {
        header("location: /products/");
        die();
    }
    if (ltrim($_POST["price"], "0") < 0) {
        header("location: /products/");
        die();
    }


    if (!isset($_FILES)) {
        header("location: /products/");
        die();
    }

    //Загрузка и валидация файла
    $filename = basename($_FILES['photo_path']['name']);
    $file = $_FILES['photo_path'];
    $extension = strtolower(substr($filename, strrpos($filename, '.') + 1));

    if (!(($extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "png") && ($file["type"] == "image/jpeg" || $file["type"] == "image/gif" || $file["type"] == "image/png") &&
        ($file["size"] < 2120000))) {
        header("location: /products/");
        die();
    }

    $uploadDir = "img/products/";
    $newFileName = uniqid() . "." . $extension;
    move_uploaded_file($file["tmp_name"], $uploadDir . $newFileName);


    //Добавление товара
    $product = [
        'title' => trim(strtoupper($_POST['title'])),
        'category_id' => trim($_POST["category_id"]),
        'count' => trim(ltrim($_POST["count"], "0")),
        'price' => trim(ltrim($_POST["price"], "0")),
        'photo_path' => $newFileName,
    ];

    createProduct($product);

    header("location: /products/");
    return true;
}


/**
 * Редактирование товара
 *
 * @return true|void
 */
function updateAction()
{
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        die();
    }

    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!isset($_POST)) {
        header("location: /products/");
        die();
    }
    if (!isset($_POST["title"]) || !isset($_POST["category_id"]) || !isset($_POST["count"]) || !isset($_POST["price"])) {
        header("location: /products/");
        die();
    }
    if (ltrim($_POST["count"], "0") < 0) {
        header("location: /products/");
        die();
    }
    if (ltrim($_POST["price"], "0") < 0) {
        header("location: /products/asdfasfd");
        die();
    }

    $product = getProductById($id);


    if (isset($_FILES['photo_path'])) {
        //Загрузка и валидация файла
        $filename = basename($_FILES['photo_path']['name']);
        $file = $_FILES['photo_path'];
        $extension = strtolower(substr($filename, strrpos($filename, '.') + 1));

        if (!(($extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "png") && ($file["type"] == "image/jpeg" || $file["type"] == "image/gif" || $file["type"] == "image/png") &&
            ($file["size"] < 2120000))) {
            header("location: /products/");
            die();
        }

        $uploadDir = "img/products/";
        $newFileName = uniqid() . "." . $extension;
        move_uploaded_file($file["tmp_name"], $uploadDir . $newFileName);

        unlink($uploadDir.$product['photo_path']);
    }

    //Добавление товара
    $updatedProduct = [
        'title' => trim(strtoupper($_POST['title'])),
        'category_id' => trim($_POST["category_id"]),
        'count' => trim(ltrim($_POST["count"], "0")),
        'price' => trim(ltrim($_POST["price"], "0")),
        'photo_path' => (isset($newFileName)) ? $newFileName : $product['photo_path'],
    ];


    updateProduct($updatedProduct, $id);

    header("location: /products/");
    return true;

}