<?php
include "../models/CategoryModel.php";
include "../models/ProductModel.php";

/**
 * Генерация страницы оформления заказа
 *
 * @return void
 */
function indexAction(){
    $orderProducts = [];

    if(isset($_SESSION['cartProductsId'])){
        $orderProducts = getProductsByIds($_SESSION['cartProductsId']);
    }

    $categories = getAllCategoriesForUl();

    render("order", compact('categories', 'orderProducts'));
}