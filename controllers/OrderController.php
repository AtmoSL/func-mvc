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

    if(isset($_SESSION['cart']) && count($_SESSION['cart']['productsId']) > 0){
        $ids = array_keys($_SESSION['cart']['productsId']);

        $orderProducts = getProductsByIds($ids);
    }

    foreach($orderProducts as $key => $orderProduct){
        $orderProducts[$key]['count'] = $_SESSION['cart']['productsId'][$orderProduct['id']]['count'];
    }

    $categories = getAllCategoriesForUl();

    render("order", compact('categories', 'orderProducts'));
}