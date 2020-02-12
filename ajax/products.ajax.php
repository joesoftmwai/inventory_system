<?php

require_once "../models/products.model.php";
require_once "../controllers/products.controller.php";

class AjaxProducts
{
    /**
     * :: GENERATE CODE FROM CATEGORY ID
     */
    public $category_id;
    public function ajaxCreateProductCode() {

        $item = 'category_id';
        $value = $this->category_id;

        $response = ProductsController::ctrShowProducts($item, $value);

        echo json_encode($response);

    }

    /**
     * :: EDIT PRODUCT
     */

    public $productId;
    public $bringProducts;
    public $productName;

    public function ajaxEditProduct() {

        if ($this->bringProducts == "ok") {
            $item = null;
            $value = null;

            $response = ProductsController::ctrShowProducts($item, $value);

            echo json_encode($response);

        } else if ($this->productName != "") {

            $item = 'description';
            $value = $this->productName;

            $response = ProductsController::ctrShowProducts($item, $value);

            echo json_encode($response);

        } else {
            $item = 'id';
            $value = $this->productId;

            $response = ProductsController::ctrShowProducts($item, $value);

            echo json_encode($response);
        }


    }













}

/**
 * :: GENERATE CODE FROM CATEGORY ID(execute)
 */

if (isset($_POST['category_id'])) {
    $productCode = new AjaxProducts();
    $productCode->category_id = $_POST['category_id'];
    $productCode->ajaxCreateProductCode();
}

/**
 * :: EDIT PRODUCT.exec
 */

if (isset($_POST['productId'])){
    $product = new AjaxProducts();
    $product->productId = $_POST['productId'];
    $product->ajaxEditProduct();
}


/**
 * :: BRING PRODUCTS.exec
 */

if (isset($_POST['bringProducts'])){
    $bringProducts = new AjaxProducts();
    $bringProducts->bringProducts = $_POST['bringProducts'];
    $bringProducts->ajaxEditProduct();
}

/**
 * :: BRING PRODUCTS BASED ON DESCRIPTION.exec
 */

if (isset($_POST['productName'])){
    $bringProducts = new AjaxProducts();
    $bringProducts->productName = $_POST['productName'];
    $bringProducts->ajaxEditProduct();
}


