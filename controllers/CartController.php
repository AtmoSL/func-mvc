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

    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
        $_SESSION['cart']['count'] = 0;
    }

    $product = getProductById($id);

    if (empty($product)) echo "Товаров нет";

    if (empty($_SESSION['cart'][$id])) {
        $_SESSION['cart']['productsId'][$id]['count'] = 1;
    } else {
        $_SESSION['cart']['productsId'][$id]['count']++;
    }

    $_SESSION['cart']['count']++;

    echo (json_encode($_SESSION['cart']['count']));
}