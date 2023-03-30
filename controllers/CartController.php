<?php

include "../models/CategoryModel.php";
include "../models/ProductModel.php";

/**
 * Добавление товара в корзину
 *
 * @return string
 */
function addToCartAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!isset($_SESSION['cartProductsId'])) $_SESSION['cartProductsId'] = [];

    $product = getProductById($id);

    if (empty($product)) return null;

    if (empty($_SESSION['cartProductsId'][$id])) {
        $_SESSION['cartProductsId'][$id]['count'] = 1;
    } else {
        $_SESSION['cartProductsId'][$id]['count']++;
    }

    return json_encode($_SESSION['cartProductsId']);
}