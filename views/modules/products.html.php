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
                    <table class="table table-bordered table-striped _tables">
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
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px">
                            </td>
                            <td>PROD-001</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum</td>
                            <td>20</td>
                            <td>$ 5.00</td>
                            <td>$ 10.00</td>
                            <td>2019-09-26 15:53:39</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px">
                            </td>
                            <td>PROD-002</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>Lorem ipsum</td>
                            <td>15</td>
                            <td>$ 7.00</td>
                            <td>$ 12.00</td>
                            <td>2019-09-26 16:00:00</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>


<!--Add product modal-->
<div id="modalAddProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" role="form" enctype="multipart/form-data">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input type="text" class="form-control" name="code" placeholder="Enter code" required>
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
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <select name="category" class="form-control" id="">
                                    <option value="">Select category</option>
                                    <option value="Vegetables">Vegetables</option>
                                    <option value="Bakery">Bakery</option>
                                </select>
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
                                    <input type="number" class="form-control" name="buying_price"
                                           placeholder="Buying price"
                                           required min="0">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrow-circle-down"></i></span>
                                    <input type="number" class="form-control" name="selling_price"
                                           placeholder="Selling price"
                                           required min="0">
                                </div>
                                <br>
                                <!--  CHECK BOX FOR PERCENTAGE  -->
                                <div class="col-xs-6">
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
                                        <input type="number" class="form-control new_percentage" min="0" value="40" required>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="form-group">
                            <div class="panel">PRODUCT IMAGE</div>
                            <input type="file" name="picture">
                            <img src="views/img/products/default/anonymous.png" alt="" class="img-thumbnail"
                                 width="100px">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="add_product" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>
</div>
