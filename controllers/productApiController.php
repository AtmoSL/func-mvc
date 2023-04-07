<?php

include '../models/ProductModel.php';

/**
 * Удаление товара
 *
 * @return void
 */
function deleteAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($_SESSION["user"]["role"] != 2) {
        echo json_encode("Пользователь не подходит");
        die();
    }

    $fileName = getProductPhotoPath($id);

    if(productDelete($id)){
        $uploadDir = "img/products/";
        unlink($uploadDir.$fileName);
    }


    echo json_encode("Товар удалён");
    die();
}