<?php
 ob_start();
 session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventory System</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!--fav-icon icon-->
    <link rel="icon" href="views/img/template/icono-negro.png">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">

    <!-- Custom style-->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">

    <!-- Date range picker -->
    <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Moris js charts css -->
    <link rel="stylesheet" href="views/bower_components/morris.js/morris.css">

    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- DataTables -->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!--Sweet alert 2-->
    <script src="views/plugins/sweetalert2/sweetalert2.js"></script>

    <!-- jQuery 3 -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Moris js charts js -->
    <script src="views/bower_components/raphael/raphael.min.js"></script>
    <script src="views/bower_components/morris.js/morris.min.js"></script>

    <!-- Chart js chart -->
    <script src="views/bower_components/chart.js/Chart.js"></script>
    

</head>


<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

<?php

if (isset($_SESSION['beginSession']) && isset($_SESSION['beginSession']) == "ok") {

    echo "<div class='wrapper'>"; // site wrapper START

    /**
     *  HEADER
     */
    include "modules/header1.php";

    /**
     * MENU
     */
    include "modules/menu.php";


    /**
     * HOME
     * .htaccess on it
     */
    if (isset($_GET["route"])) {
        if ($_GET["route"] == "home"
            || $_GET["route"] == "users"
            || $_GET["route"] == "categories"
            || $_GET["route"] == "products"
            || $_GET["route"] == "clients"
            || $_GET["route"] == "sales"
            || $_GET["route"] == "create-sales"
            || $_GET["route"] == "edit-sale"
            || $_GET["route"] == "reports"
            || $_GET["route"] == "logout") {
            include "modules/" . $_GET['route'] . ".php";
        } else {
            include "modules/404.php";
        }
    } else {
        include "modules/home.php";
    }

    /**
     * FOOTER
     */
    include "modules/footer.php";

    echo "</div>"; // site wrapper END

} else {
    /**
     *LOGIN
     * --redirected
     */
    include "modules/login.php";

}


?>






<!-- DataTables -->
<script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- SlimScroll -->
<script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- iCheck 1.0.1 -->
<script src="views/plugins/iCheck/icheck.min.js"></script>

<!-- InputMask -->
<script src="views/plugins/input-mask/jquery.inputmask.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!--JqueryNumber-->
<script src="views/plugins/jqueryNumber/jquerynumber.min.js"></script>

<!-- Date range picker -->
<script src="views/bower_components/moment/min/moment.min.js"></script>
<script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- FastClick -->
<script src="views/bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="views/dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="views/dist/js/demo.js"></script>

<script src="views/dist/js/template.js"></script>
<script src="views/dist/js/users.js"></script>
<script src="views/dist/js/categories.js"></script>
<script src="views/dist/js/products.js"></script>
<script src="views/dist/js/clients.js"></script>
<script src="views/dist/js/sales.js"></script>
<script src="views/dist/js/reports.js"></script>


</body>
</html>
