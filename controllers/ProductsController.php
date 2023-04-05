<?php

include '../models/ProductModel.php';
include '../models/CategoryModel.php';

/**
 * Вывод страницы с товарами
 *
 * @return false|void
 */
function indexAction(){
    if($_SESSION["user"]["role"] != 2){
        header("location: /");
        return false;
    }

    $products = getAllProducts();
    $productCategories = getAllCategories();

    $categories = getAllCategoriesForUl();

    render("products", compact( "products", "categories", "productCategories"));
}


/**
 * Создание нового товара
 *
 * @return true|void
 */
function createAction(){
    if(!isset($_POST)) {
        header("location: /products/");
        die();
    }
    if(!isset($_POST["title"]) || !isset($_POST["category_id"])|| !isset($_POST["count"]) || !isset($_POST["price"])) {
        header("location: /products/");
        die();
    }
    if(ltrim($_POST["count"], "0") < 0 ){
        header("location: /products/");
        die();
    }
    if(ltrim($_POST["price"], "0") < 0 ){
        header("location: /products/");
        die();
    }


    if(!isset($_FILES)){
        header("location: /products/");
        die();
    }

    $filename = basename($_FILES['photo_path']['name']);
    $file = $_FILES['photo_path'];
    $extension = strtolower(substr($filename, strrpos($filename, '.') + 1));

    if (!(($extension == "jpeg" || $extension == "jpg" || $extension == "gif" || $extension == "png") && ($file["type"] == "image/jpeg" || $file["type"] == "image/gif" || $file["type"] == "image/png") &&
        ($file["size"] < 2120000))){
        header("location: /products/");
        die();
    }

    $uploadDir = "img/products/";
    $newFileName= uniqid().".".$extension;
    move_uploaded_file($file["tmp_name"], $uploadDir.$newFileName);

    $product = [
        'title' => trim(strtoupper($_POST['title'])),
        'category_id' => trim($_POST["category_id"]),
        'count' => trim( ltrim($_POST["count"], "0")),
        'price' => trim( ltrim($_POST["price"], "0")),
        'photo_path' => $newFileName,
    ];

    createProduct($product);

    header("location: /products/");
    return true;
}