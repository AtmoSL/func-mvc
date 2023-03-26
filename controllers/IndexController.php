<?php
include "../models/ProductModel.php";


/**
 * Вывод главной страницы сайта
 *
 * @return void
 */
function indexAction(){
    $hello = "Метод index контроллера Index";
    $products = takeAllProductsWithCategories();

    render("index", compact("hello", "products"));
}