<?php

class CategoryController
{
    public function ctrlCreateCategory()
    {
        if (isset($_POST['add_category'])) {

            if (preg_match('/^[a-zA-Z0-9*-@#_! ]+$/', $_POST['category_name'])) {

                $table = "categories";
                $data = $_POST['category_name'];

                $response = CategoryModel::mdlCreateCategory($table, $data);

                if ($response == "ok") {
                    echo "<script>
                        Swal.fire({
                            type: 'success',
                            title: 'New category Added successfully',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'categories'
                               }
                            });

                        </script>";
                }
            } else {
                echo "<script>
                        Swal.fire({
                            type: 'error',
                            title: 'Error occurred while processing category field',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'categories'
                               }
                            });

                        </script>";
            }

        }
    }


    /**
     * :: SHOW CATEGORIES
     */
    public function ctrShowCategories($item, $value) {
        $table = "categories";

        $response = CategoryModel::mdlShowCategories($table, $item, $value);

        return $response;
    }


    /**
     * :: EDIT CATEGORY
     */

    public function ctrlEditCategory() {
        if (isset($_POST['edit_category'])) {
            if (preg_match('/^[a-zA-Z0-9*-@#_! ]+$/', $_POST['e_category_name'])) {
                $table = "categories";
                $data = array("category" => $_POST['e_category_name'],
                              "id" => $_POST['e_category_id']);

                $response = CategoryModel::mdlEditCategory($table, $data);

                if ($response == "ok") {
                    echo "<script>
                        Swal.fire({
                            type: 'success',
                            title: 'Category Modified successfully',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'categories'
                               }
                            });

                        </script>";
                }
            } else {
                echo "<script>
                        Swal.fire({
                            type: 'error',
                            title: 'Error occurred while processing the',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'categories'
                               }
                            });

                        </script>";
            }
        }
    }


    /**
     * :: DELETE CATEGORY
     */

    public function ctrlDeleteCategory() {
        if (isset($_GET['categoryId'])) {
            $table = "categories";
            $data = $_GET['categoryId'];

            $response = CategoryModel::mdlDeleteCategory($table, $data);

            if ($response == "ok") {
                echo "<script>
                        Swal.fire({
                            type: 'success',
                            title: 'Category deleted successfully',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            closeOnConfirm: false
                            }).then((result) => {
                               if (result.value) {
                                   window.location = 'categories'
                               }
                            });

                        </script>";
            }

        }
    }

}

