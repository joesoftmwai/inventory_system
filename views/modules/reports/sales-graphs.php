<?php

/*****  BRING ALL SALES *****/
error_reporting(0);

if(isset($_GET['startDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
} else {
    $startDate = null;
    $endDate = null;
}

$bringSales = SalesController::ctrDateRangeSales($startDate, $endDate);

$arrayDates = array();
$arraySales = array();
$addTotalPayement = array();

foreach ($bringSales as $key => $value) { 

    $date = substr($value['date'], 0, 10);
    array_push($arrayDates, $date);
    
    $arraySales = array($date => $value['total']);

   foreach($arraySales as $key => $value) {
    $addTotalPayement[$key] += $value;
   }
}


$noRepeatDates = array_unique($arrayDates);



?>


<!-- SALES GRAPH -->
<div class="box box-solid bg-teal-gradient">
    <div class="box-header">

        <i class="fa fa-th"></i>
        <h3 class="box-title">Sales Graph</h3>
        <div class="chart" id="line-chart-sales" style="height: 250px"></div>

    </div>
</div>



<script>

 var line = new Morris.Line({
    element          : 'line-chart-sales',
    resize           : true,
    data             : [
      
        <?php
            if($noRepeatDates != null) {
                foreach($noRepeatDates as $key) {
                    echo "{ y: '".$key."', Sales: ".$addTotalPayement[$key]." },";
                }
                echo "{ y: '".$key."', Sales: ".$addTotalPayement[$key]." }";
            } else {
                echo "{ y: '0', Sales: '0' }";
            }

        ?>


    ],
    xkey             : 'y',
    ykeys            : ['Sales'],
    labels           : ['Sales'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         :  '$',
    gridTextSize     : 10
  });

</script>
