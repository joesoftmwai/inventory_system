

<?php

$item = null;
$value = null;

$sales = SalesController::ctrShowSales($item, $value);
$users = UserController::ctrShowUsers($item, $value);

$sellersArray = array();
$sellersListArray = array();

foreach($sales as $key => $valueSales) {
    
    foreach($users as $key => $valueUsers) {

        if ($valueUsers['id'] == $valueSales['seller_id']) { 
            
            // capture sellers name
            array_push($sellersArray, $valueUsers['name']);

            // capture sellers and amount sold(net price)
            $sellersListArray = array($valueUsers['name'] => $valueSales['net_price']);

            // adds the total sales per each seller
           foreach ($sellersListArray as $key => $value) {

            $totalSalesPerSeller[$key] += $value;

           //  var_dump( $totalSalesPerSeller[$key]);
           
       }

        }

    }
}

// // no repeated names
$noRepeatedNames = array_unique($sellersArray);

?>



<!-- :: SELLERS -->

<div class="box box-success">

    <div class="box-header with-border">
        <h3 class="box-title">Sellers</h3>
    </div>

    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart-sellers" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>   
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart-sellers',
      resize: true,
      data: [

        <?php
            foreach ($noRepeatedNames as $value) {
                
                echo "
                    {y: '".$value."', a: ".$totalSalesPerSeller[$value]." },
                ";
            }
            ?>
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Sales'],
      preUnits: '$',
      hideHover: 'auto'
    });
</script>