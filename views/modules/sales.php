<?php

    if(($_SESSION["profile"] == 'Special')) {
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
            Manage sales
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage sales</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <a href="create-sales">
                    <button class="btn btn-primary">
                        Add Sale
                    </button>
                </a>
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>
                        <i class="fa fa-calendar"></i> Date range
                        <i class="fa fa-caret-down"></i>
                        </span>
                </button>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped _tables">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Billing Code</th>
                            <th>Customer</th>
                            <th>Seller</th>
                            <th>Payment Method</th>
                            <th>Net Price</th>
                            <th>Total Price</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <!--BRING ALL SALES FORM THE DB-->
                        <?php
                        
                        if(isset($_GET['startDate'])) {
                            $startDate = $_GET['startDate'];
                            $endDate = $_GET['endDate'];
                        } else {
                            $startDate = null;
                            $endDate = null;
                        }

                        $bringSales = SalesController::ctrDateRangeSales($startDate, $endDate);

                        foreach ($bringSales as $key => $value) {
                            $id = $value['id'];
                            $billing_code = $value['code'];
                            $client_id = $value['client_id'];
                            $seller_id = $value['seller_id'];
                            $payment_mode = $value['payment_method'];
                            $net_price = number_format($value['net_price'], 2);
                            $total_price = number_format($value['total'], 2);
                            $date = $value['date'];

                            /*
                             * fetches client name
                             */
                            $item = 'id';
                            $value = $client_id;
                            $client = ClientController::ctrShowClients($item, $value);


                            /*
                             * fetches seller name(current user logged in)
                             */
                            $_item = 'id';
                            $_value = $seller_id;
                            $seller = UserController::ctrShowUsers($_item, $_value);


                            ?>

                            <tr>
                                <td><?php echo($key + 1); ?></td>
                                <td><?php echo $billing_code; ?></td>
                                <td><?php echo $client['name']; ?></td>
                                <td><?php echo $seller["name"]; ?></td>
                                <td><?php echo $payment_mode; ?></td>
                                <td>$ <?php echo $net_price; ?></td>
                                <td>$ <?php echo $total_price; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <div class="btn-group btn-sm">
                                        <button class="btn btn-info btn-sm btnPrintBill" saleCode="<?php echo $billing_code; ?>">
                                            <i class="fa fa-print"></i>
                                        </button>

                                        <?php if(($_SESSION["profile"] == 'Administrator')): ?>

                                            <a class="btn btn-warning btn-sm"
                                            href="index.php?route=edit-sale&saleId=<?php echo $id; ?>"><i
                                                        class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-sm btnDeleteSale" saleId="<?php echo $id; ?>"><i class="fa fa-times"></i></button>

                                        <?php endif;?>
                                    </div>
                                </td>
                            </tr>

                        <? } ?>
                        </tbody>
                    </table>

                    <!--DELETE SALE-->
                    <?php
                    $deleteSale = new SalesController();
                    $deleteSale -> ctrDeleteSale();
                    ?>

                </div>

            </div>
        </div>
    </section>
</div>


<!--Add category modal-->
<div id="modalAddClient" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" role="form">

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

                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>

    </div>
</div>

