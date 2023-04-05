<?php

include "../models/OrderModel.php";
include "../models/CategoryModel.php";
include "../models/ProductModel.php";
include "../models/OrderStatusModel.php";
include "../models/UserModel.php";
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

    if($_SESSION["user"]["role"] != 2){
        if ($order["user_id"] != $_SESSION["user"]["id"]) {
            header("location: /");
            return false;
        }
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

    foreach ($products as $key => $product){
        $productCount = getProductCount($key);
        if($productCount >= $_SESSION['cart']['productsId'][$key]["count"]){
            $newCount = $productCount - $_SESSION['cart']['productsId'][$key]["count"];
            updateProductCount($key , $newCount);
        }else{
            return false;
        }
    }

    $orderId = createOrder($products, $_SESSION['cart']);
    unset($_SESSION['cart']);
    header("location:/order/$orderId/");
    return true;
}

/**
 * Вывод всех заказов пользователя
 *
 * @return void
 */
function myOrdersAction(){
    $userId = $_SESSION["user"]["id"];

    $orders = getOrderByUserId($userId);
    foreach ($orders as $key => $order){
        $orders[$key]['status_title'] = getOrderStatusTitle($order['status_id']);
    }

    $categories = getAllCategoriesForUl();
    render("myOrders", compact( "categories","orders"));
}

/**
 * Все заказы для админа
 *
 * @return false|void
 */
function allAction(){
    if($_SESSION["user"]["role"] != 2){
        header("location: /");
        return false;
    }

    $userId = $_SESSION["user"]["id"];

    $orders = getAllOrders();

    foreach ($orders as $key => $order){
        $orders[$key]['status_title'] = getOrderStatusTitle($order['status_id']);
        $orders[$key]['user'] = getUserNameAndEmail($order["user_id"]);
    }

    $statuses = getAllOrderStatuses();

    $categories = getAllCategoriesForUl();
    render("allOrders", compact( "categories","orders", "statuses"));
}

/**
 * Отмена заказа
 *
 * @return false|void
 */
function cancelAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $order = getOrderById($id);

    if($order["user_id"] != $_SESSION["user"]["id"] && $_SESSION["user"]["id"]!=2){
        debug("Не тот юзер");
        header("location: /order/myorders/");
        return false;
    }

    $orderProducts = getOrderProducts($order["id"]);

    foreach ($orderProducts as $orderProduct){
        $product = getProductById($orderProduct["product_id"]);

        $newCount = $product["count"] + $orderProduct["count"];

        updateProductCount($orderProduct["product_id"], $newCount);
    }

    $statusId = 3;

    $newStatusId = changeOrderStatus($order["id"], $statusId);

    if($newStatusId != 3) return false;

    header("location: /order/myorders/");
    die();

}