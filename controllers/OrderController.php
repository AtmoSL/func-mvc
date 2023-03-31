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

    if(isset($_SESSION['cart'])){
        $ids = array_keys($_SESSION['cart']['productsId']);

        $orderProducts = getProductsByIds($ids);
    }

    $categories = getAllCategoriesForUl();

    render("order", compact('categories', 'orderProducts'));
}