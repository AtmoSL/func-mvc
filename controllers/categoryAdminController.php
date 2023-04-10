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