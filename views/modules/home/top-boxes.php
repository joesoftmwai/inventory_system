<?php

    $item = null;
    $value = null;

    /** :: total sales */ 
    $sales = SalesController::ctrTotalSales();
    foreach ($sales as $key => $value) {
        $totalSales = number_format($value['total'], 2);
    }

    /** :: total sales */ 
    $categories = CategoryController::ctrShowCategories($item, $value);
    $totalCategories = count($categories);

    /** :: total clients */ 
    $clients = ClientController::ctrShowClients($item, $value);
    $totalClients = count($clients);

    /** :: total products */ 
    $products = ProductsController::ctrShowProducts($item, $value);
    $totalProducts = count($products);

    
?>


    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
        <div class="inner">
            <h3>$ <?php echo $totalSales; ?></h3>

            <p>Sales</p>
        </div>
        <div class="icon">
            <i class="ion ion-social-usd"></i>
        </div>
        <a href="sales" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
        <div class="inner">
            <h3><?php echo $totalCategories; ?></h3>

            <p>Categories</p>
        </div>
        <div class="icon">
            <i class="ion ion-clipboard"></i>
        </div>
        <a href="categories" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?php echo $totalClients; ?></h3>

            <p>Clients</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="clients" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
   
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
        <div class="inner">
            <h3><?php echo $totalProducts;?></h3>

            <p>Products</p>
        </div>
        <div class="icon">
            <i class="ion ion-ios-cart"></i>
        </div>
        <a href="products" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>