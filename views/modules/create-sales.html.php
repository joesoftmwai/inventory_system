<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Create sales
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create sales</li>
        </ol>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">

                    </div>
                    <form action="" method="post" autocomplete="off">
                        <div class="box-body">
                            <div class="box">

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="seller" name="seller"
                                               value="Admin User" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="text" class="form-control" id="billing_code" name="billing_code"
                                               value="013088" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                        <select name="" class="form-control" id="">
                                            <option value="">Select Customer</option>
                                        </select>

                                        <span class="input-group-addon">
                                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal"
                                                    data-target="#modalAddClient">
                                                Add Customer
                                            </button>
                                        </span>

                                    </div>
                                </div>

                                <!--Entry to add new product-->
                                <div class="form-group row new_product">

                                    <!--product description-->
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <button type="button" class="btn btn-danger btn-xs">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </span>
                                            <input type="text" class="form-control" name="add_product"
                                                   placeholder="product-description">
                                        </div>
                                    </div>

                                    <!--product quantity-->
                                    <div class="col-xs-3">
                                        <input type="number" class="form-control" id="product_quantity"
                                               name="product_quantity" min="0"
                                               placeholder="0">
                                    </div>

                                    <!--product price-->
                                    <div class="col-xs-3">
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" id="product_price"
                                                   name="product_price"
                                                   placeholder="0000" readonly required>
                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="add-product" class="btn btn-default hidden-lg btn-sm">Add
                                    product
                                </button>
                                <hr>

                                <!--Input for Taxes and Total-->

                                <div class="row">
                                    <div class="col-xs-8 pull-right">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Tax</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td style="width: 50%">
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="new_tax_sales"
                                                               name="new_tax_sales"
                                                               placeholder="0" required>
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-percent"></i></span>
                                                    </div>
                                                </td>


                                                <td style="width: 50%">
                                                    <div class="input-group">
                                                        <input type="number" min="1" class="form-control"
                                                               id="new_total_sales" name="new_total_sales"
                                                               placeholder="0000" readonly required>
                                                        <span class="input-group-addon"><i
                                                                class="ion ion-social-usd"></i></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>

                                <!--payment method-->

                                <div class="row form-group">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <select name="new_payment_mode" id="new_payment_mode" class="form-control"
                                                    required>
                                                <option value="">select payment method</option>
                                                <option value="cash">cash</option>
                                                <option value="debit_card">debit_card</option>
                                                <option value="credit_card">credit_card</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="new_transaction_code"
                                                   name="new_transaction_code"
                                                   placeholder="Transaction Code" required>
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <br>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="save_new_sale" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">
                    <div class="box box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped _tables">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>1</td>
                                <td><img src="views/img/products/default/anonymous.png" alt="" width="40px"></td>
                                <td>CODE-123</td>
                                <td>lorem ipsum dolor sit</td>
                                <td>20</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Add</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>

</div>


<!--add new client-->
<div id="modalAddClient" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" method="post" role="form" autocomplete="off">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Client</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control" name="document_id"
                                       placeholder="Enter document id" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Enter email"
                                       required>
                            </div>
                        </div>

                        <!-- masking the phone input field-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" name="phone" placeholder="Enter phone no"
                                       data-inputmask="'mask':'(999) 999-999999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control" name="address" placeholder="Enter address"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" name="date_of_birth"
                                       placeholder="Enter date of birth"
                                       data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="add_client" class="btn btn-primary">Save</button>
                </div>

            </form>

            <!-- create new client.exec-->
            <?php
            $createClient = new ClientController();
            $createClient->ctrCreateClient();
            ?>

        </div>

    </div>
</div>