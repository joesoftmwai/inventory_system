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
                    <form action="" method="post" autocomplete="off" class="sales_form">
                        <div class="box-body">
                            <div class="box">

                                <?php

                                $item1a = "id";
                                $value1a = $_GET['saleId'];

                                $sales = SalesController::ctrShowSales($item1a, $value1a);

                                $item1b = "id";
                                $value1b = $sales['seller_id'];

                                $seller = UserController::ctrShowUsers($item1b, $value1b);

                                $item1c = "id";
                                $value1c = $sales['client_id'];

                                $client = ClientController::ctrShowClients($item1c, $value1c);


                                ?>


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="seller" name="seller"
                                               value="<?php echo $seller['name'] ?>" readonly>
                                        <input type="hidden" name="sellerId" value="<?php echo $seller["id"]; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="text" class="form-control" id="billing_code" name="billing_code"
                                               value="<?php echo $sales['code']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                        <select name="selectClient" class="form-control" id="selectClient">
                                            <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>

                                            <?php
                                            $item = null;
                                            $value = null;

                                            $client = ClientController::ctrShowClients($item, $value);

                                            foreach ($client as $key => $value) {
                                                $id = $value['id'];
                                                $name = $value['name'];

                                                ?>

                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                            <?php } ?>


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

                                    <?php

                                    $listProducts = json_decode($sales['products'], true);

                                    foreach ($listProducts as $key => $value) {

                                        $_item = 'id';
                                        $_value = $value['id'];

                                        $products = ProductsController::ctrShowProducts($_item, $_value);

                                        $oldStock = $products['stock'] + $value['quantity'];

                                        $taxPercentage = $sales['tax'] * 100 / $sales['total'];

                                        ?>


                                        <!--appending new product desc, stock && price-->
                                        <div class="row" style="padding: 5px 15px">
                                            <!--product description-->
                                            <div class="col-xs-6 _description">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <button type="button"
                                                                class="btn btn-danger btn-xs removeProduct"
                                                                productId="<?php echo $value['id']; ?>">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </span>
                                                    <input type="text" class="form-control add_product"
                                                           name="add_product"
                                                           productId="<?php echo $value['id']; ?>"
                                                           value="<?php echo $value['description']; ?>" readonly>
                                                </div>
                                            </div>

                                            <!--product quantity-->
                                            <div class="col-xs-3 _stock">
                                                <input type="number" class="form-control product_quantity"
                                                       id="product_quantity"
                                                       name="product_quantity" min="0"
                                                       stock="<?php echo $oldStock; ?>"
                                                       productId="<?php echo $value['id']; ?>"
                                                       newStock="<?php echo $products['stock']; ?>" value="<?php echo $value['quantity']; ?>">
                                            </div>

                                            <!--product price-->
                                            <div class="col-xs-3 _price">
                                                <div class="input-group">
                                                    <input type="text" class="form-control product_price"
                                                           id="product_price"
                                                           name="product_price"
                                                           realPrice="<?php echo $products['selling_price']; ?>"
                                                           value="<?php echo $value['price']; ?>" readonly required>
                                                    <span class="input-group-addon"><i
                                                                class="ion ion-social-usd"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>


                                </div>

                                <input type="hidden" name="listProducts" id="_listProducts">

                                <button type="submit" name="add-product"
                                        class="btn btn-default hidden-lg btn-sm btnAddProduct">Add
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
                                                        <input type="number" min="0" class="form-control"
                                                               id="new_tax_sales"
                                                               name="new_tax_sales"
                                                               value="<?php echo $taxPercentage; ?>">
                                                        <input type="hidden" id="new_tax_price" name="new_tax_price" value="<?php echo $sales['tax']; ?>">
                                                        <input type="hidden" id="new_net_price" name="new_net_price" value="<?php echo $sales['net_price']; ?>">
                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </td>


                                                <td style="width: 50%">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control "
                                                               id="new_total_sales" name="new_total_sales"
                                                               total="<?php echo $sales['net_price'];?>" value="<?php echo $sales['total'];?>" readonly required>
                                                        <input type="hidden" name="total_sales" id="total_sales" value="<?php echo $sales['total'];?>">
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
                                                <option value="Cash">Cash</option>
                                                <option value="DB">Debit Card</option>
                                                <option value="CC">Credit Card</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="payment_mode_boxes">

                                    </div>
                                    <input type="hidden" name="listPaymentMethod" class="listPaymentMethod">
                                </div>
                                <br>

                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="edit_sale" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>

                    <!--EDIT SALE.-->
                    <?php
                    $editSale = new SalesController();
                    $editSale->ctrEditSale();
                    ?>

                </div>
            </div>

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">
                    <div class="box box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped _product_sales_tables">
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

                            <!--                            <tbody>-->
                            <!--                            <tr>-->
                            <!--                                <td>1</td>-->
                            <!--                                <td><img src="views/img/products/default/anonymous.png" alt="" width="40px"></td>-->
                            <!--                                <td>CODE-123</td>-->
                            <!--                                <td>lorem ipsum dolor sit</td>-->
                            <!--                                <td>20</td>-->
                            <!--                                <td>-->
                            <!--                                    <div class="btn-group">-->
                            <!--                                        <button type="button" class="btn btn-primary">Add</button>-->
                            <!--                                    </div>-->
                            <!--                                </td>-->
                            <!--                            </tr>-->
                            <!--                            </tbody>-->


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
