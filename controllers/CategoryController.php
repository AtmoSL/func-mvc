<?php

include "../models/CategoryModel.php";
include "../models/ProductModel.php";


/**
 * Вывод страницы категорий
 *
 * @return void
 */
function indexAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $children = null;
    $category = getCategory($id);

    if($category["parent_id"] == 0){
        $children = getChildrenForCat($id);
    }

    $products = getProductsByCategory($id);


    $categories = getAllCategoriesForUl();
    render('category', compact('products', 'children', 'category', 'categories'));
}