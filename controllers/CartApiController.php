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
        $_SESSION['cart']['total_price'] = 0;
    }

    $product = getProductById($id);
    if (empty($product)) die();

    if (empty($_SESSION['cart']['productsId'][$id] && $product['count'] != 0)) {
        $_SESSION['cart']['productsId'][$id]['count'] = 1;
        $_SESSION['cart']['productsId'][$id]['total_price'] = $product['price'];
        $_SESSION['cart']['count']++;
    }

    if ($_SESSION['cart']['productsId'][$id]['count'] < $product['count']) {

        $_SESSION['cart']['productsId'][$id]['count']++;
        $_SESSION['cart']['productsId'][$id]['total_price'] += $product['price'];

        $_SESSION['cart']['total_price'] += $product['price'];

        $_SESSION['cart']['count']++;
    }

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
        $_SESSION['cart']['total_price'] -= $_SESSION['cart']['productsId'][$id]['total_price'];

        unset($_SESSION['cart']['productsId'][$id]);
    }

    echo(json_encode($_SESSION['cart']['count']));
}

function minusFromCartAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $productCount = 0;
    $productTotalPrice = 0;
    $cartTotalPrice = 0;

    $product = getProductById($id);
    if (empty($product)) echo "Товаров нет";

    if (!empty($_SESSION['cart']['productsId'][$id])) {


        $_SESSION['cart']['count']--;
        $_SESSION['cart']['productsId'][$id]['count']--;
        $_SESSION['cart']['productsId'][$id]['total_price'] -= $product['price'];
        $_SESSION['cart']['total_price'] -= $product['price'];

        $productCount = $_SESSION['cart']['productsId'][$id]['count'];
        $productTotalPrice = $_SESSION['cart']['productsId'][$id]['total_price'];
        $cartTotalPrice = $_SESSION['cart']['total_price'];

        if ($_SESSION['cart']['productsId'][$id]['count'] == 0) {
            unset($_SESSION['cart']['productsId'][$id]);
        }
    }

    $result = [
        "count" => $_SESSION['cart']['count'],
        "productCount" => $productCount,
        "productTotalPrice" => $productTotalPrice,
        "cartTotalPrice" => $cartTotalPrice,
    ];

    echo(json_encode($result));

}

function plusCartAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $productCount = 0;
    $productTotalPrice = 0;
    $cartTotalPrice = 0;

    $product = getProductById($id);
    if (empty($product)) echo "Товаров нет";

    if (empty($_SESSION['cart']['productsId'][$id])) die();

    if ($_SESSION['cart']['productsId'][$id]['count'] < $product['count']) {
        $_SESSION['cart']['count']++;
        $_SESSION['cart']['productsId'][$id]['count']++;
        $_SESSION['cart']['productsId'][$id]['total_price'] += $product['price'];
        $_SESSION['cart']['total_price'] += $product['price'];
    }
    
    $productCount = $_SESSION['cart']['productsId'][$id]['count'];
    $productTotalPrice = $_SESSION['cart']['productsId'][$id]['total_price'];
    $cartTotalPrice = $_SESSION['cart']['total_price'];

    $result = [
        "count" => $_SESSION['cart']['count'],
        "productCount" => $productCount,
        "productTotalPrice" => $productTotalPrice,
        "cartTotalPrice" => $cartTotalPrice,
    ];

    echo(json_encode($result));

}