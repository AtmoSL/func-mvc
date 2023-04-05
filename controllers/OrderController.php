<?php

include "../models/OrderModel.php";
include "../models/CategoryModel.php";
include "../models/ProductModel.php";
include "../models/OrderStatusModel.php";
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

    $order['status_title'] = getOrderStatusTitle($order["status_id"]);

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


    $orderId = createOrder($products, $_SESSION['cart']);
    unset($_SESSION['cart']);
    header("location:/order/$orderId/");
    return true;
}

function myOrdersAction(){
    $userId = $_SESSION["user"]["id"];

    $orders = getOrderByUserId($userId);
    foreach ($orders as $key => $order){
        $orders[$key]['status_title'] = getOrderStatusTitle($order['status_id']);
    }

    $categories = getAllCategoriesForUl();
    render("myOrders", compact( "categories","orders"));
}