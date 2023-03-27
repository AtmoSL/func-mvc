<?php

include "../models/CategoryModel.php";
include "../models/ProductModel.php";


/**
 * Вывод главной страницы сайта
 *
 * @return void
 */
function indexAction(){
    $products = getAllProductsWithCategories();
    $categories = getAllCategoriesForUl();

    render("index", compact( "products", "categories"));
}