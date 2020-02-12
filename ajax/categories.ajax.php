<?php

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class AjaxCategories
{
    /**
     * :: EDIT CATEGORIES
     */
    public $categoryId;

    public function ajaxEditCategories()
    {
        $item = "id";
        $value = $this->categoryId;

        $response = CategoryController::ctrShowCategories($item, $value);

        echo json_encode($response);
    }
}

/**
 * :: EDIT CATEGORIES
 */

if (isset($_POST["categoryId"])) {
    $category = new AjaxCategories();
    $category->categoryId = $_POST["categoryId"];
    $category->ajaxEditCategories();
}