<?php
include '../models/CategoryModel.php';
include '../models/ProductModel.php';

/**
 * Вывод страницы редактирования категорий
 *
 * @return false|void
 */
function indexAction(){
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        return false;
    }

    $allCategoriesParents = getAllParentsCategories();
    $allCategories = getAllCategories();

    $categories = getAllCategoriesForUl();

    render("categoryAdmin", compact("allCategoriesParents", "categories", "allCategories"));
}

/**
 * Создание категории
 *
 * @return bool
 */
function createAction(){
    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        return false;
    }

    if(!validationCategory()){
        header("location: /categoryadmin/");
        return false;
    }

    $newCategory = [
        'title' => $_POST['title'],
        'parent_id' => $_POST['parent_id']
    ];

    $category = createCategory($newCategory);

    if(!$category) {
        header("location: /categoryadmin/");
        return false;
    }


    header("location: /categoryadmin/");
    return true;
}

function updateAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        return false;
    }

    if(!validationCategory()){
        header("location: /categoryadmin/");
        return false;
    }

    $newCategory = [
        'title' => $_POST['title'],
        'parent_id' => $_POST['parent_id']
    ];

    $category = updateCategory($id, $newCategory);

    if(!$category){
        header("location: /categoryadmin/");
        return false;
    }

    header("location: /categoryadmin/");
    return true;
}

function deleteAction(){
    $categoryId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($_SESSION["user"]["role"] != 2) {
        header("location: /");
        return false;
    }

    if(!existCategory($categoryId)){
        header("location: /categoryadmin/");
        return false;
    }

    resetProductsCategory($categoryId);

    deleteCategory($categoryId);

    header("location: /categoryadmin/");

    return true;
}