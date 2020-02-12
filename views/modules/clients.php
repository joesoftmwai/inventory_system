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
            Manage clients
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage clients</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddClient">
                    Add Client
                </button>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped _tables">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Document Id</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Total purchases</th>
                            <th>Last Purchase</th>
                            <th>Last Login</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <!--show clients dynamically-->
                        <?php

                        $item = null;
                        $value = null;

                        $clients = ClientController::ctrShowClients($item, $value);

                        foreach ($clients as $key => $value) {
                            $id = $value['id'];
                            $name = $value['name'];
                            $document_id = $value['document_id'];
                            $email = $value['email'];
                            $phone = $value['phone'];
                            $address = $value['address'];
                            $date_of_birth = $value['date_of_birth'];
                            $purchases = $value['purchases'];
                            $last_purchase = $value['last_purchase'];
                            $date = $value['date'];


                            ?>

                            <tr>
                                <td><?php echo($key + 1); ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $document_id; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $date_of_birth; ?></td>
                                <td><?php echo $purchases; ?></td>
                                <td><?php echo $last_purchase; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <div class="btn-group btn-sm">
                                        <button class="btn btn-warning btn-sm btnEditClient" data-toggle="modal"
                                                data-target="#modalEditClient"
                                                clientId="<?php echo $id; ?>"><i class="fa fa-pencil"></i></button>

                                        <?php if(($_SESSION["profile"] == 'Administrator')): ?>

                                            <button class="btn btn-danger btn-sm btnDeleteClient"
                                                    clientId="<?php echo $id; ?>"><i class="fa fa-times"></i></button>
                                        
                                        <?php endif;?>

                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>


<!--Add client modal-->
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

<!--Edit client modal-->
<div id="modalEditClient" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" method="post" role="form" autocomplete="off">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Client</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="e_name" name="e_name" required>
                                <!--sends the edit id-->
                                <input type="hidden" id="clientId" name="clientId">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control" id="e_document_id"
                                       name="e_document_id"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" id="e_email" name="e_email"
                                       required>
                            </div>
                        </div>

                        <!-- masking the phone input field-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" id="e_phone" name="e_phone"
                                       data-inputmask="'mask':'(999) 999-999999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control" id="e_address" name="e_address"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" id="e_date_of_birth" name="e_date_of_birth"
                                       data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="edit_client" class="btn btn-primary">Save</button>
                </div>

            </form>

            <!-- edit existing client.exec-->
            <?php
            $editClient = new ClientController();
            $editClient->ctrEditClient();
            ?>

        </div>

    </div>
</div>


<!--delete client-->
<?php
$delete_client = new ClientController();
$delete_client->ctrDeleteClient();

?>