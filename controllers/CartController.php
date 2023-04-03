<?php
include "../models/CategoryModel.php";
include "../models/ProductModel.php";

/**
 * Генерация страницы оформления заказа
 *
 * @return void
 */
function indexAction(){
    $cartProducts = [];

    if(isset($_SESSION['cart']) && count($_SESSION['cart']['productsId']) > 0){
        $ids = array_keys($_SESSION['cart']['productsId']);

        $cartProducts = getProductsByIds($ids);
    }

    foreach($cartProducts as $key => $cartProduct){
        $cartProducts[$key]['count'] = $_SESSION['cart']['productsId'][$cartProduct['id']]['count'];
    }

    $categories = getAllCategoriesForUl();

    render("cart", compact('categories', 'cartProducts'));
}