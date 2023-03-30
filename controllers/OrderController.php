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
        $ids = array_keys($_SESSION['cartProductsId']);

        $orderProducts = getProductsByIds($ids);
    }

    $categories = getAllCategoriesForUl();

    render("order", compact('categories', 'orderProducts'));
}