<?php

include "../models/CategoryModel.php";
include "../models/ProductModel.php";

/**
 * Добавление товара в корзину
 *
 *
 */
function addToCartAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
        $_SESSION['cart']['count'] = 0;
    }

    $product = getProductById($id);

    if (empty($product)) echo "Товаров нет";

    if (empty($_SESSION['cart']['productsId'][$id])) {
        $_SESSION['cart']['productsId'][$id]['count'] = 1;
    } else {
        $_SESSION['cart']['productsId'][$id]['count']++;
    }

    $_SESSION['cart']['count']++;

    echo(json_encode($_SESSION['cart']['count']));
}

/**
 * Удаление товара из корзины
 *
 * @return void
 */
function deleteFromCartAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!empty($_SESSION['cart']['productsId'][$id])) {
        $_SESSION['cart']['count'] -= $_SESSION['cart']['productsId'][$id]['count'];

        unset($_SESSION['cart']['productsId'][$id]);
    }

    echo(json_encode($_SESSION['cart']['count']));
}

function minusFromCartAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $productCount = 0;

    if (!empty($_SESSION['cart']['productsId'][$id])) {

        $_SESSION['cart']['count']--;
        $_SESSION['cart']['productsId'][$id]['count']--;

        $productCount = $_SESSION['cart']['productsId'][$id]['count'];

        if($_SESSION['cart']['productsId'][$id]['count'] == 0){
            unset($_SESSION['cart']['productsId'][$id]);
        }
    }

    $result = [
        "count" => $_SESSION['cart']['count'],
        "productCount" => $productCount,
    ];

    echo(json_encode($result));

}