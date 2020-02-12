<?php

    if(($_SESSION["profile"] == 'Seller')) {
        echo '
            <script>
                window.location="home"
            </script>
            ';
        return;
    }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage products
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage products</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct">
                    Add product
                </button>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped _product_tables">


                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <!--                        <tbody>-->
                        <!---->
                        <!--                        --><?php
                        //
                        //                        $item = null;
                        //                        $value = null;
                        //                        $products = ProductsController::ctrShowProducts($item, $value);
                        //                        $srNo = 0;
                        //
                        //                        foreach ($products as $key => $value) {
                        //                            $id = $value["id"];
                        //                            $category_id = $value["category_id"];
                        //                            $code = $value["code"];
                        //                            $description = $value["description"];
                        //                            $image = $value["image"];
                        //                            $stock = $value["stock"];
                        //                            $buying_price = $value["buying_price"];
                        //                            $selling_price = $value["selling_price"];
                        //                            $sales = $value["sales"];
                        //                            $date = $value["date"];
                        //
                        //                            $srNo++;
                        //
                        //                            ?>
                        <!---->
                        <!---->
                        <!--                            <tr>-->
                        <!--                                <td>--><?php //echo $srNo; ?><!--</td>-->
                        <!--                                <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail"-->
                        <!--                                         width="40px">-->
                        <!--                                </td>-->
                        <!--                                <td>--><?php //echo $code; ?><!--</td>-->
                        <!--                                <td>--><?php //echo $description; ?><!--</td>-->
                        <!---->
                        <!--                                --><?php
                        //                                $item = 'id';
                        //                                $value = $category_id;
                        //                                $category = CategoryController::ctrShowCategories($item, $value);
                        //                                ?>
                        <!---->
                        <!--                                <td>--><?php //echo $category['name']; ?><!--</td>-->
                        <!--                                <td>--><?php //echo $stock; ?><!--</td>-->
                        <!--                                <td>--><?php //echo $buying_price; ?><!--</td>-->
                        <!--                                <td>--><?php //echo $selling_price; ?><!--</td>-->
                        <!--                                <td>--><?php //echo $date; ?><!--</td>-->
                        <!--                                <td>-->
                        <!--                                    <div class="btn-group">-->
                        <!--                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>-->
                        <!--                                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>-->
                        <!--                                    </div>-->
                        <!--                                </td>-->
                        <!--                            </tr>-->
                        <!---->
                        <!--                        --><? // } ?>
                        <!---->
                        <!--                        </tbody>-->


                    </table>
                    
                    <!-- sends a hidden profile name because of yo be processed by ajax -->
                    <input type="hidden" value="<?php echo $_SESSION["profile"]; ?>" id="hiddeProfile">

                </div>

            </div>
        </div>
    </section>
</div>


<!--Add product modal-->
<div id="modalAddProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <select name="category" class="form-control" id="newCategory">
                                        <option value="">Select category</option>
                                        <?php
                                        $item = null;
                                        $value = null;

                                        $category = CategoryController::ctrShowCategories($item, $value);
                                        foreach ($category as $key => $value) {
                                            $cat_id = $value['id'];
                                            $cat_name = $value['name'];

                                            ?>

                                            <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Enter code"
                                       required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input type="text" class="form-control" name="description"
                                       placeholder="Enter description"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                <input type="number" class="form-control" name="stock" placeholder="Stock"
                                       required min="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-circle-up"></i></span>
                                    <input type="number" class="form-control" id="buying_price"
                                           name="buying_price" placeholder="Buying price"
                                           required min="0" step="any">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-circle-down"></i></span>
                                    <input type="number" class="form-control" id="selling_price"
                                           name="selling_price" placeholder="Selling price"
                                           required min="0" step="any">
                                </div>
                                <br>
                                <!--  CHECK BOX FOR PERCENTAGE  -->
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="">
                                            <input type="checkbox" class="minimal percentage" checked>
                                            Use percentage
                                        </label>
                                    </div>
                                </div>

                                <!--  INPUT FOR PERCENTAGE  -->
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input type="number" class="form-control new_percentage" min="0" value="40"
                                               required>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="form-group">
                            <div class="panel">PRODUCT IMAGE</div>
                            <input type="file" name="image" class="new_image">
                            <img src="views/img/products/default/anonymous.png" alt="" class="img-thumbnail preview"
                                 width="100px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="add_product" class="btn btn-primary">Save</button>
                </div>

            </form>

            <?php
            $createProduct = new ProductsController();
            $createProduct->ctrCreateProduct();
            ?>

        </div>

    </div>
</div>


<!--Edit product modal-->
<div id="modalEditProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <select name="e_category" class="form-control" id="editCategory" readonly>
                                        <option id="e_category"></option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input type="text" class="form-control" name="e_code" id="e_code" required readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input type="text" class="form-control" id="e_description"
                                       name="e_description" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                <input type="number" class="form-control" id="e_stock" name="e_stock"
                                       required min="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-circle-up"></i></span>
                                    <input type="number" class="form-control" id="e_buying_price" name="e_buying_price"
                                           required min="0" step="any">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-circle-down"></i></span>
                                    <input type="number" class="form-control" id="e_selling_price"
                                           name="e_selling_price" required min="0" step="any" readonly>
                                </div>
                                <br>
                                <!--  CHECK BOX FOR PERCENTAGE  -->
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="">
                                            <input type="checkbox" class="minimal percentage" checked>
                                            Use percentage
                                        </label>
                                    </div>
                                </div>

                                <!--  INPUT FOR PERCENTAGE  -->
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input type="number" class="form-control new_percentage" min="0" value="40"
                                               required>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="form-group">
                            <div class="panel">PRODUCT IMAGE</div>
                            <input type="file" name="e_image" class="new_image">
                            <img src="views/img/products/default/anonymous.png" alt="" class="img-thumbnail preview"
                                 width="100px">
                            <input type="hidden" name="existing_image" id="existing_image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="edit_product" class="btn btn-primary">Save</button>
                </div>

            </form>

            <?php
            $editProduct = new ProductsController();
            $editProduct->ctrEditProduct();
            ?>

        </div>

    </div>
</div>

<!--delete product.exec-->
<?php
$deleteProduct = new ProductsController();
$deleteProduct->ctrDeleteProduct();
?>

