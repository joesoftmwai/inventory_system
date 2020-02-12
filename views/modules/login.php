<!--login-box-->
<div class="login-box">

    <div class="login-logo">
        <img src="views/img/template/logo-blanco-bloque.png" alt="" class="img-responsive"
             style="padding: 30px 100px 0px 100px">
    </div>
    <!-- /.login-logo -->

    <div class="login-box-body">
        <p class="login-box-msg">Login in to the system</p>

        <form autocomplete="off" method="post">

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="username" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                </div>
            </div>


            <?php

            $login = new UserController();
            $login->ctrUserLogin();
            ?>

        </form>

    </div>
</div>
