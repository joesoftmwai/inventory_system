<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
        <?php
            if ($_SESSION["profile"] == 'Administrator') {
                include "views/modules/home/top-boxes.php";
            }
            
        ?>
    </div>

    <div class="row">

      <div class="col-lg-12">
        <?php
            if ($_SESSION["profile"] == 'Administrator') {
                include "views/modules/reports/sales-graphs.php";
            }
            
        ?>
      </div>

    </div>

    <div class="row">

        <div class="col-lg-6">
            <?php 
                 if ($_SESSION["profile"] == 'Administrator') {
                    include "views/modules/reports/best-seller-products.php";
                  }
                
            ?>
        </div>

        <div class="col-lg-6">
            <?php
                if ($_SESSION["profile"] == 'Administrator') { 
                    include "views/modules/home/recent-products.php";
                }
                
            ?>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">

             <?php if ($_SESSION["profile"] == 'Special' || $_SESSION["profile"] == 'Seller') : ?>
                
             <div class="box box-success">
                <div class="box-header">
                    <h1>Welcome @ <?php echo $_SESSION["name"] ;?></h1>
                </div>
             </div>
                   
            <?php endif;?> 
             
            
        </div>
    </div>

    </section>
    <!-- /.content -->
</div>
