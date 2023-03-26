<?php
include "../models/ProductModel.php";


/**
 * Вывод главной страницы сайта
 *
 * @return void
 */
function indexAction(){
    $products = takeAllProductsWithCategories();
    $categories = takeAllCategoriesForUl();

    render("index", compact( "products", "categories"));
}