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