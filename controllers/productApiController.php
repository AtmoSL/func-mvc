<?php

include '../models/ProductModel.php';

function deleteAction(){
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($_SESSION["user"]["role"] != 2) {
        die();
    }

    $fileName = getProductPhotoPath($id);

    if(productDelete($id)){
        $uploadDir = "img/products/";
        unlink($uploadDir.$fileName);
    }


    echo json_encode("Товар удалён");
}