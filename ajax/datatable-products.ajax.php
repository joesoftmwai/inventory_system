<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class ProductsTable
{

    /**
     * :: SHOW PRODUCTS TABLE
     */
    public function showProductsTable()
    {
        $item = null;
        $value = null;

        $products = ProductsController::ctrShowProducts($item, $value);

        $jsonData = '{ "data": [';
        for ($i = 0; $i < count($products); $i++) {

            if ($products[$i]["image"] != "") {
                $image = "<img src='".$products[$i]["image"]."' width='40px'>";
            } else {
                $image = "<img src='views/img/products/default/anonymous.png' width='40px'>";
            }

            $code = $products[$i]["code"];
            $description = $products[$i]["description"];
            $stock = $products[$i]["stock"];
            $buying_price = $products[$i]["buying_price"];
            $selling_price = $products[$i]["selling_price"];
            $date = $products[$i]["date"];

            /**
             * :: stock
             */
            if ($stock <= 10) {
                $stock = "<div class='btn btn-danger'>".$products[$i]["stock"]."</div>";
            } elseif ($stock > 11 && $stock <= 15) {
                $stock = "<div class='btn btn-warning'>".$products[$i]["stock"]."</div>";
            } else {
                $stock = "<div class='btn btn-success'>".$products[$i]["stock"]."</div>";
            }



            /**
             * :: fetching category-name from categories table
             */
            $item = 'id';
            $value = $products[$i]['category_id'];
            $category = CategoryController::ctrShowCategories($item, $value);

            /**
             * :: shows the edit and delete buttons
             */

            if (isset($_GET['hiddenProfile']) && $_GET['hiddenProfile'] == 'Special') {
                $buttons = "<div class='btn-group'><button class='btn btn-warning btnEditProduct' productId='".$products[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button></div>";
            } else {
                $buttons = "<div class='btn-group'><button class='btn btn-warning btnEditProduct' productId='".$products[$i]["id"]."' data-toggle='modal' data-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' productId='".$products[$i]["id"]."' code='".$products[$i]["code"]."' image='".$products[$i]["image"]."'><i class='fa fa-times'></i></button></div>";
            }



            $jsonData .= ' [
                "'.($i+1).'",
                "' . $image . '",
                "' . $code . '",
                "'.$description.'",
                "'.$category['name'].'",
                 "'.$stock.'",
                "'.$buying_price.'",
                "'.$selling_price.'",
                "'.$date.'",
                "' . $buttons . '"
                ],';
        }
        $jsonData = substr($jsonData, 0, -1);
         $jsonData .= '] }';


        echo $jsonData;



    }
}

/**
 * :: ACTIVATE PRODUCTS TABLE
 */

$activateProducts = new ProductsTable();
$activateProducts->showProductsTable();
