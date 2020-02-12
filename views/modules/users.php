<?php

    if(($_SESSION["profile"] == 'Seller') && ($_SESSION["profile"] == 'Special')) {
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
            Manage users
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdduser">
                    Add User
                </button>


                <!--Add user modal-->
                <div id="modalAdduser" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <form action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">

                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add User</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="name"
                                                       placeholder="Enter name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                <input type="text" class="form-control" name="username"
                                                       id="username" placeholder="Enter username"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" class="form-control" name="password"
                                                       placeholder="Enter password"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                <select name="profile" class="form-control" id="">
                                                    <option value="">Select profile</option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Special">Special</option>
                                                    <option value="Seller">Seller</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="panel">USER PICTURE</div>
                                            <input type="file" name="picture" class="form-control new_picture">
                                            <p>Maximum size is 2MB</p>
                                            <img src="views/img/users/default/anonymous.png" alt=""
                                                 class="img-thumbnail preview" width="100px">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>

                                <?php
                                $createUser = new UserController();
                                $createUser->ctrCreateUser();
                                ?>
                            </form>
                        </div>

                    </div>
                </div>


            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped _tables">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Picture</th>
                            <th>Profile</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $item = null;
                        $value = null;

                        $users = UserController::ctrShowUsers($item, $value);

                        foreach ($users as $key => $value) {
                            $id = $value["id"];
                            $name = $value["name"];
                            $username = $value["username"];
                            $profile = $value["profile"];
                            $picture = $value["picture"];
                            $status = $value["status"];
                            $last_login = $value["last_login"];

                            ?>

                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $username; ?></td>

                                <?php if ($picture != null): ?>
                                <td><img src="<?php echo $picture; ?>" alt="" class="img-thumbnail"/>
                                    <?php else: ?>
                                <td><img src="views/img/users/default/anonymous.png" alt="" class="img-thumbnail"/>
                                    <?php endif; ?>


                                <td><?php echo $profile; ?></td>
                                <td>
                                    <?php if ($status == 0): ?>
                                        <button class="btn btn-danger btn_activate" userId="<?php echo $id; ?>"
                                                userStatus="1">Deactivated
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-success btn_activate" userId="<?php echo $id; ?>"
                                                userStatus="0">Activated
                                        </button>
                                    <?php endif; ?>

                                </td>
                                <td><?php echo $last_login; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning btnEditUsers" userId="<?php echo $id; ?>"
                                                data-toggle="modal" data-target="#modalEditUser"><i
                                                    class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btnDeleteUsers" userId="<?php echo $id; ?>"
                                                userPicture="<?php echo $picture; ?>" user="<?php echo $username; ?>"><i
                                                    class="fa fa-times"></i>
                                        </button>
                                        <?php
                                        $deleteUser = new UserController();
                                        $deleteUser->ctrDeleteUser();
                                        ?>
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


<!--Edit User modal-->
<div id="modalEditUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" role="form" method="post" enctype="multipart/form-data" autocomplete="off">

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="e_name" id="e_name"
                                       placeholder="Enter name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" name="e_username" id="e_username"
                                       placeholder="Enter username"
                                       readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="e_password" id="e_password"
                                       placeholder="Enter password">
                                <input type="hidden" id="current_password" name="current_password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select name="e_profile" id="e_profile" class="form-control" id="e_profile">
                                    <option value="">Select profile</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Special">Special</option>
                                    <option value="Seller">Seller</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="panel">USER PICTURE</div>
                            <input type="file" name="e_picture" class="form-control new_picture">
                            <p>Maximum size is 2MB</p>
                            <img src="views/img/users/default/anonymous.png" alt=""
                                 class="img-thumbnail preview" width="100px">

                            <input type="hidden" name="current_picture" id="current_picture">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="e_submit" class="btn btn-primary">Save</button>
                </div>

                <!--edit client-->
                 <?php
                  $editUser = new UserController();
                  $editUser->ctrEditUser();
               ?>
                
            </form>
        </div>

    </div>
</div>





