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
    $cartTotalPrice = 0;
    if(!isset($_SESSION['cart'])){
        $categories = getAllCategoriesForUl();
        render("cart", compact('categories', 'cartProducts', 'cartTotalPrice'));
    }

    if(isset($_SESSION['cart']) && count($_SESSION['cart']['productsId']) > 0){
        $ids = array_keys($_SESSION['cart']['productsId']);

        $cartProducts = getProductsByIds($ids);

    }

    foreach($cartProducts as $key => $cartProduct){
        $cartProducts[$key]['count'] = $_SESSION['cart']['productsId'][$cartProduct['id']]['count'];
        $cartProducts[$key]['total_price'] = $_SESSION['cart']['productsId'][$cartProduct['id']]['total_price'];
    }

    $cartTotalPrice = $_SESSION['cart']['total_price'];

    $categories = getAllCategoriesForUl();
    render("cart", compact('categories', 'cartProducts', 'cartTotalPrice'));

}