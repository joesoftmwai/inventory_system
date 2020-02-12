
<?php

$item = null;
$value = null;

$sales = SalesController::ctrShowSales($item, $value);
$clients = ClientController::ctrShowClients($item, $value);

$clientsArray = array();
$clientsListArray = array();

foreach($sales as $key => $valueSales) {
    
    foreach($clients as $key => $valueClients) {

        if ($valueClients['id'] == $valueSales['client_id']) { 
            
            // capture clients name
            array_push($clientsArray, $valueClients['name']);
            
            // capture clients and amount purchased(net price)
            $clientsListArray = array($valueClients['name'] => $valueSales['net_price']);

            foreach ($clientsListArray as $key => $value) {

                // total purchases per client
                $totalPurchsesPerClient[$key] += $value;
    
            }
        }
    }
}

// no repeated names
$noRepeatedNames = array_unique($clientsArray);


?>



<!-- :: CLIENTS -->

<div class="box box-primary">

    <div class="box-header with-border">
        <h3 class="box-title">Clients</h3>
    </div>

    <div class="box-body">
        <div class="chart-responsive">
            <div class="chart" id="bar-chart-clients" style="height: 300px;"></div>
        </div>
    </div>
</div>

<script>   
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart-clients',
      resize: true,
      data: [

        <?php
            foreach ($noRepeatedNames as $value) {
                
                echo "
                    {y: '".$value."', a: ".$totalPurchsesPerClient[$value]." },
                ";
            }
            ?>
      ],
      barColors: ['#f6a'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Purchases'],
      preUnits: '$',
      hideHover: 'auto'
    });
</script>