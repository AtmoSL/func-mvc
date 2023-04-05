<?php

include "../models/OrderModel.php";
include "../models/CategoryModel.php";
include "../models/ProductModel.php";
/**
 * Вывод страницы заказа
 *
 * @return bool
 */
function indexAction()
{
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if (!isset($_SESSION["user"])) {
        header("location: /login/");
        $_SESSION["messages"][] = "Необходимо авторизироваться, чтобы просмотреть заказ.";
        return false;
    }

    $order = getOrderById($id);

    if(!$order) {
        header("location: /");
        return false;
    }
    if ($order["user_id"] != $_SESSION["user"]["id"]) {
        header("location: /");
        return false;
    }

    $orderProducts = getOrderProducts($order["id"]);
    $products = [];


    foreach ($orderProducts as $orderProduct){
        $product = getProductById($orderProduct["product_id"]);

        $product["count"] = $orderProduct["count"];
        $product["category"] = getCategory($product["category_id"]);
        $product['total_price'] = $orderProduct['total_price'];

        $products[] = $product;
    }

    $categories = getAllCategoriesForUl();
    render("order", compact( "categories", "products", "order"));
}

/**
 * Функция создания заказа
 *
 * @return bool
 */
function createAction()
{
    if (!isset($_SESSION["user"])) {
        header("location: /login/");
        $_SESSION["messages"][] = "Необходимо авторизироваться, чтобы оформить заказ.";
        return false;
    }
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']['productsId']) == 0) {
        header("location: /catalog/");
        return false;
    }

    $products = $_SESSION['cart']['productsId'];

    $orderId = createOrder($products);

    header("location:/order/$orderId/");
    return true;
}