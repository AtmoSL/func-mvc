<?php

/**
 * Получение многомерного массива дерева категорий
 *
 * @return array
 */
function getAllCategoriesForUl()
{

    $categories = getAllParentsCategories();

    foreach ($categories as &$category) {
        $children = getChildrenForCat($category['id']);
        if ($children) {
            $category['children'] = $children;
        }
    }

    return $categories;
}

/**
 * Получение категории по id
 *
 * @param $id
 * @return array
 */
function getCategory($id)
{
    $sql = "SELECT * FROM `categories` WHERE id = $id";

    $result = mysqliQueryOneArray($sql);

    return $result;
}

/**
 * Получение дочерних категорий для основной
 *
 * @param $id
 * @return array
 */
function getChildrenForCat($id)
{
    $sql = "SELECT *
            FROM `categories`
            WHERE `parent_id` = '$id'";

    $result = mysqliQueryArray($sql);

    return $result;
}

/**
 * Получение всех категорий
 *
 * @return array
 */
function getAllCategories()
{
    $sql = "SELECT *
            FROM `categories`
            WHERE `id` > '1'";

    $result = mysqliQueryArray($sql);

    return $result;
}

/**
 * Получение всех родительских категорий
 *
 *
 * @return array
 */
function getAllParentsCategories()
{
    $sql = "SELECT *
            FROM `categories`
            WHERE `parent_id` = '0'";

    $result = mysqliQueryArray($sql);

    return $result;
}

/**
 * Создание категории
 *
 * @param $category
 * @return true
 */
function createCategory($category)
{
    extract($category);

    $sql = "INSERT INTO `categories` (`id`, `parent_id`, `title`) VALUES (NULL, '$parent_id', '$title')";

    mysqliSql($sql);

    return true;
}

/**
 * Является ли категория родительской
 *
 * @param $categoryId
 * @return bool
 */
function isItParentCategory($categoryId)
{
    $sql = "SELECT `parent_id` FROM `categories` WHERE `id` = '$categoryId'";

    $result = mysqliQueryOneArray($sql);

    if ($result['parent_id'] == 0) {
        return true;
    } else {
        return false;
    }

}

function validationCategoryForCreate()
{
    if (!isset($_POST)) {
        return false;
    }

    if (!isset($_POST['title']) && trim($_POST['title']) != '') {
        return false;
    }

    if (!isset($_POST['parent_id'])) {
        return false;
    }

    if (!isItParentCategory($_POST['parent_id'])) {
        return false;
    }
    return true;
}