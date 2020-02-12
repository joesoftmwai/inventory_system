<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";


class SalesProductsTable
{

    /**
     * :: SHOW PRODUCTS TABLE
     */
    public function showSalesProductsTable()
    {
        $item = null;
        $value = null;

        $products = ProductsController::ctrShowProducts($item, $value);

        $jsonData = '{ "data": [';
        for ($i = 0; $i < count($products); $i++) {

            if ($products[$i]["image"] != "") {
                $image = "<img src='" . $products[$i]["image"] . "' width='40px'>";
            } else {
                $image = "<img src='views/img/products/default/anonymous.png' width='40px'>";
            }

            $id = $products[$i]["id"];
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
                $stock = "<div class='btn btn-danger'>" . $products[$i]["stock"] . "</div>";
            } elseif ($stock > 11 && $stock <= 15) {
                $stock = "<div class='btn btn-warning'>" . $products[$i]["stock"] . "</div>";
            } else {
                $stock = "<div class='btn btn-success'>" . $products[$i]["stock"] . "</div>";
            }


            /**
             * :: shows the edit and delete buttons
             */
            $buttons = "<div class='btn-group'><button class='btn btn-primary addProduct recoverButton' productId='" . $id . "'>Add</button></div>";


            $jsonData .= ' [
                "' . ($i + 1) . '",
                "' . $image . '",
                "' . $code . '",
                "' . $description . '",
                 "' . $stock . '",
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

$activateSalesProducts = new SalesProductsTable();
$activateSalesProducts->showSalesProductsTable();
