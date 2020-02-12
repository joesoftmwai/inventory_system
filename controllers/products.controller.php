<?php

class ProductsController
{
    public function ctrShowProducts($item, $value)
    {
        $table = "products";

        $response = ProductsModel::mdlShowProducts($table, $item, $value);

        return $response;
    }

    /**
     * :: CREATE NEW PRODUCT
     */
    public function ctrCreateProduct()
    {
        if (isset($_POST['add_product'])) {


            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['description'])
                && preg_match('/^[0-9]+$/', $_POST['stock'])
                && preg_match('/^[0-9.]+$/', $_POST['buying_price'])
                && preg_match('/^[0-9.]+$/', $_POST['selling_price'])) {

                /**
                 * :: VALIDATE IMAGE
                 */

                $route = "";
                if (isset($_FILES["image"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["image"]["tmp_name"]);
                    $new_width = 50;
                    $new_height = 50;

                    $directory = "views/img/products/" . $_POST['code'];
                    mkdir($directory, 0777);

                    if ($_FILES["image"]["type"] == "image/jpeg") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/products/" . $_POST['code'] . "/" . $rand . ".jpg";

                        $source = imagecreatefromjpeg($_FILES["image"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destiny, $route);
                    }

                    if ($_FILES["image"]["type"] == "image/png") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/products/" . $_POST['code'] . "/" . $rand . ".png";

                        $source = imagecreatefrompng($_FILES["image"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destiny, $route);
                    }
                }


                $table = 'products';
                $data = array(
                    "category_id" => $_POST['category'],
                    "code" => $_POST['code'],
                    "description" => $_POST['description'],
                    "stock" => $_POST['stock'],
                    "buying_price" => $_POST['buying_price'],
                    "selling_price" => $_POST['selling_price'],
                    "image" => $route
                );

                $response = ProductsModel::mdlAddProduct($table, $data);

                if ($response == "ok") {
                    echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Product Added successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'products'
                           }
                        });

                </script>";
                }

            } else {
                echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Product cannot be empty or use specific characters',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'products'
                           }
                        });

                </script>";
            }
        }
    }


    /**
     * :: EDIT PRODUCT
     */
    public function ctrEditProduct()
    {
        if (isset($_POST['edit_product'])) {

            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['e_description'])
                && preg_match('/^[0-9]+$/', $_POST['e_stock'])
                && preg_match('/^[0-9.]+$/', $_POST['e_buying_price'])
                && preg_match('/^[0-9.]+$/', $_POST['e_selling_price'])) {

                /**
                 * :: VALIDATE IMAGE
                 */

                $route = $_POST['existing_image'];

                if (isset($_FILES["e_image"]["tmp_name"]) && !empty($_FILES["e_image"]["tmp_name"])) {
                    list($width, $height) = getimagesize($_FILES["e_image"]["tmp_name"]);
                    $new_width = 50;
                    $new_height = 50;

                    $directory = "views/img/products/" . $_POST['e_code'];

                    if (!empty($_POST["existing_image"])) {
                        unlink($_POST["existing_image"]);
                    } else {
                        mkdir($directory, 0777);
                    }


                    if ($_FILES["e_image"]["type"] == "image/jpeg") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/products/" . $_POST['e_code'] . "/" . $rand . ".jpg";

                        $source = imagecreatefromjpeg($_FILES["e_image"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagejpeg($destiny, $route);
                    }

                    if ($_FILES["e_image"]["type"] == "image/png") {
                        $rand = mt_rand(100, 999);
                        $route = "views/img/products/" . $_POST['e_code'] . "/" . $rand . ".png";

                        $source = imagecreatefrompng($_FILES["e_image"]["tmp_name"]);
                        $destiny = imagecreatetruecolor($new_width, $new_height);

                        imagecopyresized($destiny, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                        imagepng($destiny, $route);
                    }
                }



               


                $table = 'products';
                $data = array(
                    "category_id" => $_POST['e_category'],
                    "code" => $_POST['e_code'],
                    "description" => $_POST['e_description'],
                    "stock" => $_POST['e_stock'],
                    "buying_price" => $_POST['e_buying_price'],
                    "selling_price" => $_POST['e_selling_price'],
                    "image" => $route
                );

                $response = ProductsModel::mdlEditProduct($table, $data);

                if ($response == "ok") {
                    echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Product Edited successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'products'
                           }
                        });

                </script>";
                }

            } else {
                echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Product cannot be empty or use specific characters',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'products'
                           }
                        });

                </script>";
            }
        }
    }

    /**
     * ::DELETE PRODUCT
     */

    public function ctrDeleteProduct()
    {

        if (isset($_GET['productId'])) {
            $table = "products";
            $data = $_GET['productId'];

            if ($_GET['image'] != "" && $_GET['image'] != "views/img/products/default/anonymous.png") {
                unlink($_GET['image']);
                rmdir("views/img/products/" . $_GET['code']);
            }

            $response = ProductsModel::mdlDeleteProduct($table, $data);

            if ($response == "ok") {
                echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Product Deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'products'
                           }
                        });

                </script>";
            }

        }

    }

    /**
     * :: SHOW SALES SUM
     */

     public function ctrShowSalesSum() {

         $table = 'products';
         $response = ProductsModel::mdlShowSalesSum($table);
         return $response;

     }

}

