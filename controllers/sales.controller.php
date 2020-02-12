<?php

class SalesController
{
    public function ctrShowSales($item, $value)
    {

        $table = 'sales';
        $response = SalesModel::mdlShowSales($table, $item, $value);
        return $response;

    }

    /**
     * :: CREATE SALES
     */

    public function ctrCreateSale()
    {

        if (isset($_POST['save_new_sale'])) {
            /**
             * :: Update the purchase of the client and reduce stock
             */
            $listProducts = json_decode($_POST['listProducts'], true);

            //array for total products purchased
            $totalProductsPurchased = array();

            //var_dump($listProducts);

            foreach ($listProducts as $key => $value) {

                array_push($totalProductsPurchased, $value['quantity']);

                $table = 'products';
                $item = "id";
                $_value = $value['id'];

                $bringProducts = ProductsModel::mdlShowProducts($table, $item, $_value);

                //var_dump($bringProducts['sales']);

                $item1a = 'sales';
                $value1a = $value['quantity'] + $bringProducts['sales'];


                $newSales = ProductsModel::mdlUpdateProduct($table, $item1a, $value1a, $_value);

                $item1b = 'stock';
                $value1b = $value['stock'];

                $newStock = ProductsModel::mdlUpdateProduct($table, $item1b, $value1b, $_value);


            }

            /**
             * :: update clients purchases
             */
            $tableClients = 'clients';
            $item = "id";
            $_value = $_POST['selectClient'];
            $bringClients = ClientModel::mdlShowClients($tableClients, $item, $_value);

            $item1a = 'purchases';
            $value1a = array_sum($totalProductsPurchased) + $bringClients['purchases'];

            $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item1a, $value1a, $_value);

            $item1b = 'last_purchase';

            date_default_timezone_set("Africa/Nairobi");
            $date = date('Y-m-d');
            $hour = date("H:i:s");

            $value1b = $date . ' ' . $hour;

            $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item1b, $value1b, $_value);


            /**
             * :: save the sales
             */
            $table = 'sales';
            $data = array(
                "code" => $_POST['billing_code'],
                "seller_id" => $_POST['sellerId'],
                "client_id" => $_POST['selectClient'],
                "products" => $_POST['listProducts'],
                "tax" => $_POST['new_tax_price'],
                "net_price" => $_POST['new_net_price'],
                "total" => $_POST['total_sales'],
                "payment_method" => $_POST['listPaymentMethod']
            );

            $response = SalesModel::mdlCreateSales($table, $data);

            if ($response == "ok") {
                echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'The sale saved successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'sales'
                           }
                        });

                </script>";
            }


        }
    }


    /**
     * :: EDIT SALES
     */

    public function ctrEditSale()
    {

        if (isset($_POST['edit_sale'])) {

            /**
             * :: Format table clients and products table
             */
            $table = 'sales';

            $item = 'code';
            $value = $_POST['billing_code'];

            $bringSale = SalesModel::mdlShowSales($table, $item, $value);

            /**
             * :: Check if we have edited products
             */

            if ($_POST['listProducts'] == "") {
                $listProducts = $bringSale['products'];
                $changeProduct = false;
            } else {
                $listProducts = $_POST['listProducts'];
                $changeProduct = true;
            }


            if ($changeProduct) {

                $products = json_decode($bringSale['products'], true);

                $totalProductsPurchased = array();

                foreach ($products as $key => $value) {

                    array_sum($totalProductsPurchased);

                    $_table = "products";
                    $_item = 'id';
                    $_value = $value['id'];

                    $bringProducts = ProductsModel::mdlShowProducts($_table, $_item, $_value);

                    $item1a = 'sales';
                    $value1a = $bringProducts['sales'] - $value['quantity'];

                    $newSales = ProductsModel::mdlUpdateProduct($table, $item1a, $value1a, $_value);

                    $item1b = 'stock';
                    $value1b = $value['quantity'] + $bringProducts['stock'];

                    $newStock = ProductsModel::mdlUpdateProduct($table, $item1b, $value1b, $_value);


                }


                /**
                 * :: update clients purchases
                 */
                $tableClients = 'clients';
                $itemClient = "id";
                $valueClient = $_POST['selectClient'];

                $bringClients = ClientModel::mdlShowClients($tableClients, $itemClient, $valueClient);


                $item1a = 'purchases';
                $value1a = $bringClients['purchases'] - array_sum($totalProductsPurchased);

                $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item1a, $value1a, $valueClient);

                /**
                 * :: Update the purchase of the client and reduce stock
                 */
                $_listProducts = json_decode($listProducts, true);

                //array for total products purchased
                $_totalProductsPurchased = array();

                //var_dump($listProducts);

                foreach ($_listProducts as $key => $value) {

                    array_push($_totalProductsPurchased, $value['quantity']);

                    $_table = 'products';
                    $_item = "id";
                    $__value = $value['id'];

                    $_bringProducts = ProductsModel::mdlShowProducts($_table, $_item, $__value);


                    $_item1a = 'sales';
                    $_value1a = $value['quantity'] + $_bringProducts['sales'];


                    $_newSales = ProductsModel::mdlUpdateProduct($_table, $_item1a, $_value1a, $__value);

                    $_item1b = 'stock';
                    $_value1b = $value['stock'];

                    $_newStock = ProductsModel::mdlUpdateProduct($_table, $_item1b, $_value1b, $__value);


                }

                /**
                 * :: update clients purchases_
                 */
                $_tableClients = 'clients';
                $_item = "id";
                $__value = $_POST['selectClient'];
                $_bringClients = ClientModel::mdlShowClients($_tableClients, $_item, $__value);

                $_item1a = 'purchases';
                $_value1a = array_sum($_totalProductsPurchased) + $_bringClients['purchases'];

                $_customerPurchases = ClientModel::mdlUpdateClient($_tableClients, $_item1a, $_value1a, $__value);

                $_item1b = 'last_purchase';

                date_default_timezone_set("Africa/Nairobi");
                $_date = date('Y-m-d');
                $_hour = date("H:i:s");

                $_value1b = $_date . ' ' . $_hour;

                $_customerPurchases = ClientModel::mdlUpdateClient($_tableClients, $_item1b, $_value1b, $__value);

            }


            /**
             * :: save the sales
             */
            $table = 'sales';
            $data = array(
                "code" => $_POST['billing_code'],
                "seller_id" => $_POST['sellerId'],
                "client_id" => $_POST['selectClient'],
                "products" => $listProducts,
                "tax" => $_POST['new_tax_price'],
                "net_price" => $_POST['new_net_price'],
                "total" => $_POST['total_sales'],
                "payment_method" => $_POST['listPaymentMethod']
            );

            $response = SalesModel::mdlEditSales($table, $data);

            if ($response == "ok") {
                echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'The sale has been edited successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'sales'
                           }
                        });

                </script>";
            }
        }
    }


    public function ctrDeleteSale()
    {
        if (isset($_GET['saleId'])) {

            $table = 'sales';
            $item = 'id';
            $value = $_GET['saleId'];

            $bringSale = SalesModel::mdlShowSales($table, $item, $value);

            /**
             * :: Update the last purchase
             */

            $_item = null;
            $_value = null;

            $_bringAllSales = SalesModel::mdlShowSales($table, $_item, $_value);

            $savePurchaseDates = array();

            foreach ($_bringAllSales as $key => $value) {

                if ($value['client_id'] == $bringSale['client_id']) {

                    array_push($savePurchaseDates, $value['date']);

                }
            }

            $tableClients = 'clients';

            if (count($savePurchaseDates) > 1) {
                if ($bringSale['date'] > $savePurchaseDates[count($savePurchaseDates) - 2]) {

                    $item = 'last_purchase';
                    $value = $savePurchaseDates[count($savePurchaseDates) - 2];
                    $_value = $bringSale['client_id'];

                    $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item, $value, $_value);
                } else {

                    $item = 'last_purchase';
                    $value = $savePurchaseDates[count($savePurchaseDates) - 1];
                    $_value = $bringSale['client_id'];

                    $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item, $value, $_value);
                }
            } else {

                $item = 'last_purchase';
                $value = '0000-00-00 00:00:00';
                $_value = $bringSale['client_id'];

                $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item, $value, $_value);

            }


            /**
             * :: FORMAT PRODUCTS AND CLIENTS TABLE
             */

            $products = json_decode($bringSale['products'], true);

            $totalProductsPurchased = array();

        

            foreach ($products as $key => $value) {

                 array_push($totalProductsPurchased, $value['quantity']);

                $_table = "products";
                $_item = 'id';
                $_value = $value['id'];

                $bringProducts = ProductsModel::mdlShowProducts($_table, $_item, $_value);

                $item1a = 'sales';
                $value1a = $bringProducts['sales'] - $value['quantity'];


                $newSales = ProductsModel::mdlUpdateProduct($table, $item1a, $value1a, $_value);

                $item1b = 'stock';
                $value1b = $value['quantity'] + $bringProducts['stock'];

                $newStock = ProductsModel::mdlUpdateProduct($table, $item1b, $value1b, $_value);


            }


            /**
             * :: update clients purchases
             */
            $tableClients = 'clients';
            $itemClient = "id";
            $valueClient = $bringSale['client_id'];

            $bringClients = ClientModel::mdlShowClients($tableClients, $itemClient, $valueClient);

            var_dump("arraySum".array_sum($totalProductsPurchased));
            var_dump("ClientPurchases".$bringClients['purchases']);

            $item1a = 'purchases';
            $value1a = $bringClients['purchases'] - array_sum($totalProductsPurchased);

            $customerPurchases = ClientModel::mdlUpdateClient($tableClients, $item1a, $value1a, $valueClient);


            /**
             * :: DELETE SALE
             */


            $response = SalesModel::mdDeleteSale($table, $_GET['saleId']);

            echo '<script>alert(.$value.)</script>';

            if ($response == "ok") {
                echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Sale deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'sales'
                           }
                        });

                </script>";
            }

        }
    }


    /**
     * :: DATE RANGES
     */

     public function ctrDateRangeSales($startDate, $endDate) {

         $table = 'sales';
         $response = SalesModel::mdlDateRangeSales($table, $startDate, $endDate);
         return $response;
     }

     /**
      * :: DOWNLOAD REPORT IN EXCEL
      */

      public function ctrDownloadReport() {

          if (isset($_GET['report'])) {

            $table = 'sales';

            if(isset($_GET['startDate']) && isset($_GET['endDate'])) {

                $sales = SalesModel::mdlDateRangeSales($table, $_GET['startDate'], $_GET['endDate']);

            } else {

                $item = null;
                $value = null;
                $sales = SalesModel::mdlShowSales($table, $item, $value);

            }

            /**
             * :: create the excel file
             */

            $name = $_GET['report'].'.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Excel file
            header("Cache-Control: cache, must-revalidate"); 
            header('Content-Description: File Transfer');
            header('Last-Modified: '.date('D, d M Y H:i:s'));
            header("Pragma: public"); 
            header('Content-Disposition:; filename="'.$name.'"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 
            
                <tr>
                <td style='font-weight:bold; border:1px solid #eee;'>Code</td> 
                <td style='font-weight:bold; border:1px solid #eee;'>Client</td>
                <td style='font-weight:bold; border:1px solid #eee;'>Seller</td>
                <td style='font-weight:bold; border:1px solid #eee;'>Quantity</td>
                <td style='font-weight:bold; border:1px solid #eee;'>Products</td>
                <td style='font-weight:bold; border:1px solid #eee;'>Tax</td>
                <td style='font-weight:bold; border:1px solid #eee;'>Net Price</td>		
                <td style='font-weight:bold; border:1px solid #eee;'>Total Price</td>		
                <td style='font-weight:bold; border:1px solid #eee;'>Payment Method</td>
                <td style='font-weight:bold; border:1px solid #eee;'>Date</td>	
                </tr>");

                foreach ($sales as $row => $item) {
                    $client = ClientController::ctrShowClients('id', $item['client_id']);
                    $seller = UserController::ctrShowUsers('id', $item['seller_id']);

                    echo utf8_decode("<tr>
                        <td style='border: 1px solid #eee'>".$item['code']."</td>
                        <td style='border: 1px solid #eee'>".$client['name']."</td>
                        <td style='border: 1px solid #eee'>".$seller['name']."</td>

                        <td style='border: 1px solid #eee'>");

                            $products = json_decode($item['products'], true);
                               foreach ($products as $key => $valueProducts) {
                                   echo utf8_decode($valueProducts['quantity']."<br>");
                               }

                        echo utf8_decode("</td>

                        <td style='border: 1px solid #eee'>");

                            $products = json_decode($item['products'], true);
                            foreach ($products as $key => $valueProducts) {
                                echo utf8_decode($valueProducts['description']."<br>");
                            }

                        echo utf8_decode("</td>
                        
                        <td style='border: 1px solid #eee'>$ ".number_format($item['tax'], 2)."</td>
                        <td style='border: 1px solid #eee'>$ ".number_format($item['net_price'], 2)."</td>
                        <td style='border: 1px solid #eee'>$ ".number_format($item['total'], 2)."</td>
                        <td style='border: 1px solid #eee'>".$item['payment_method']."</td>
                        <td style='border: 1px solid #eee'>".substr($item['date'], 0, 10)."</td>");

                        
                    echo "</tr>";
                   
                }

            echo "</table>";

          }
      }

      /**
       * :: TOTAL SALES
       */

       public function ctrTotalSales() {
           $table = 'sales';

           $response = SalesModel::mdlTotalSales($table);

           return $response;
       }

}

