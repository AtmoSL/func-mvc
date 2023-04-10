<?php
include '../models/CategoryModel.php';

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

    if(!validationCategoryForCreate()){
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