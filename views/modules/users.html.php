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
                        <tr>
                            <td>1</td>
                            <td>Admin user</td>
                            <td>admin</td>
                            <td><img src="views/img/users/default/anonymous.png" alt="" class="img-thumbnail"/>
                            <td>Administrator</td>
                            <td>
                                <button class="btn btn-danger">Deactivated</button>
                            </td>
                            <td>2019-09-21 13:36:47</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>

                            </td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Admin user</td>
                            <td>admin</td>
                            <td><img src="views/img/users/default/anonymous.png" alt="" class="img-thumbnail"/>
                            <td>Administrator</td>
                            <td>
                                <button class="btn btn-success">Activated</button>
                            </td>
                            <td>2019-09-21 13:36:47</td>
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


<!--Add user modal-->
<div id="modalAdduser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form action="" role="form" enctype="multipart/form-data">

            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add User</h4>
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
                            <input type="text" class="form-control" name="username" placeholder="Enter username"
                                   required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="text" class="form-control" name="password" placeholder="Enter password"
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
                        <div class="panel">RAISE PICTURE</div>
                        <input type="file" name="picture" >
                        <img src="views/img/users/default/anonymous.png" alt="" class="img-thumbnail" width="100px">
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
