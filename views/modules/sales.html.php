<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage saless
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
                        <tr>
                            <td>1</td>
                            <td>SALE-0018</td>
                            <td>Jackson Jacobs</td>
                            <td>Eliud Mestas</td>
                            <td>TC-920390088</td>
                            <td>$ 800</td>
                            <td>$ 1000</td>
                            <td>2019-10-01</td>
                            <td>
                                <div class="btn-group btn-sm">
                                    <button class="btn btn-info btn-sm"><i class="fa fa-print"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
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

