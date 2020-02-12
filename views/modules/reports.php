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
            Reports
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <button type="button" class="btn btn-default" id="_daterange-btn">
                    <span>
                        <i class="fa fa-calendar"></i> Date range
                        <i class="fa fa-caret-down"></i>
                    </span>
                </button>

                <!-- DOWNLOAD REPORT IN EXCEL -->
                
                <div class="box-tools pull-right">

                    <?php 

                     if(isset($_GET['startDate'])) {
                         
                        echo '<a href="views/modules/download-reports.php?report=report&startDate='.$_GET['startDate'].'&endDate='.$_GET['endDate'].'"
                        class="btn btn-success" style="margin-top: 5px">Export to Excel</a>';

                     } else {
                        echo '<a href="views/modules/download-reports.php?report=report" class="btn btn-success" style="margin-top: 5px">Export to Excel</a>';
                     }
                    
                    ?>
                    
                </div>



            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-12">

                        <?php
                         include "views/modules/reports/sales-graphs.php"
                        ?>
                    </div>

                    <div class="col-xs-12 col-md-6">
                       <?php
                        include "views/modules/reports/best-seller-products.php" ;
                       ?>
                    </div>

                    <div class="col-xs-12 col-md-6">
                       <?php
                        include "views/modules/reports/sellers.php" ;
                       ?>
                    </div>

                    <div class="col-xs-12 col-md-6">
                       <?php
                        include "views/modules/reports/clients.php" ;
                       ?>
                    </div>


                </div>
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
