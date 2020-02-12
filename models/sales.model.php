<?php

require_once 'connection.php';

class SalesModel
{
    public function mdlShowSales($table, $item, $value)
    {
        if ($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $value);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table}");
            $stmt->execute();
            return $stmt->fetchAll();

        }
    }


    /**
     * :: CREATE NEW  SALE
     */

    public function mdlCreateSales($table, $data)
    {
        $stmt = Connection::connect()->prepare("INSERT INTO {$table} (code, seller_id, client_id, products, tax, net_price, total, payment_method) 
                 VALUES (:code, :seller_id, :client_id, :products, :tax, :net_price, :total, :payment_method)");
        $stmt->bindParam(":code", $data['code'], PDO::PARAM_STR);
        $stmt->bindParam(":seller_id", $data['seller_id'], PDO::PARAM_INT);
        $stmt->bindParam(":client_id", $data['client_id'], PDO::PARAM_INT);
        $stmt->bindParam(":products", $data['products'], PDO::PARAM_STR);
        $stmt->bindParam(":tax", $data['tax'], PDO::PARAM_STR);
        $stmt->bindParam(":net_price", $data['net_price'], PDO::PARAM_STR);
        $stmt->bindParam(":total", $data['total'], PDO::PARAM_STR);
        $stmt->bindParam(":payment_method", $data['payment_method'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /**
     * @param $table
     * @param $data
     * :: EDIT SALES
     */

    public function mdlEditSales($table, $data) {

        $stmt = Connection::connect()->prepare("UPDATE {$table} SET code = :code, seller_id = :seller_id, client_id = :client_id, products = :products,
                tax = :tax, net_price = :net_price, total = :total, payment_method = :payment_method WHERE code = :code ");
        $stmt->bindParam(":code", $data['code'], PDO::PARAM_STR);
        $stmt->bindParam(":seller_id", $data['seller_id'], PDO::PARAM_INT);
        $stmt->bindParam(":client_id", $data['client_id'], PDO::PARAM_INT);
        $stmt->bindParam(":products", $data['products'], PDO::PARAM_STR);
        $stmt->bindParam(":tax", $data['tax'], PDO::PARAM_STR);
        $stmt->bindParam(":net_price", $data['net_price'], PDO::PARAM_STR);
        $stmt->bindParam(":total", $data['total'], PDO::PARAM_STR);
        $stmt->bindParam(":payment_method", $data['payment_method'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


    /**
     * :: DELETE SALES
     */

    public function mdDeleteSale($table, $value) {
        $stmt = Connection::connect()->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(":id", $value);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

     /**
     * :: DATE RANGE
     */

    public function mdlDateRangeSales($table, $startDate, $endDate) { 
        if($startDate == null) {

            $stmt = Connection::connect()->prepare("SELECT * FROM {$table}");
            $stmt->execute();
            return $stmt->fetchAll();

         } elseif($startDate == $endDate) {

            $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE date LIKE '%$endDate%'");
            $stmt->execute();
            return $stmt->fetchAll();

         } else {

            $actualDate = new DateTime();
            $actualDate -> add(new DateInterval("P1D"));
            $actualDatePlusOne = $actualDate->format("Y-m-d");

            $endDate2 = new DateTime($endDate);
            $endDate2 -> add(new DateInterval("P1D"));
            $endDatePlusOne = $endDate2->format("Y-m-d");

            if($endDatePlusOne == $actualDatePlusOne) {
                $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE date BETWEEN '$startDate' AND  '$endDatePlusOne'");
            } else {
                $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE date BETWEEN '$startDate' AND  '$endDate'");
            }

            


            $stmt->execute();
            return $stmt->fetchAll();

         }
    }


    /**
     * :: TOTAL SALES
     */
    public function mdlTotalSales($table) {

    $stmt = Connection::connect()->prepare("SELECT SUM(net_price) as total FROM {$table}");
    $stmt->execute();
    return $stmt->fetchAll();

    }

}