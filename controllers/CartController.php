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

    if (!isset($_SESSION['cartProductsId'])) $_SESSION['cartProductsId'] = [];

    $product = getProductById($id);

    if (empty($product)) echo "Товаров нет";

    if (empty($_SESSION['cartProductsId'][$id])) {
        $_SESSION['cartProductsId'][$id]['count'] = 1;
    } else {
        $_SESSION['cartProductsId'][$id]['count']++;
    }

    echo (json_encode($_SESSION['cartProductsId']));
}