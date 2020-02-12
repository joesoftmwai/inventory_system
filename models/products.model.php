<?php

require_once "connection.php";

class ProductsModel
{
    public function mdlShowProducts($table, $item, $value) {

        if ($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE {$item}=:$item ORDER BY id DESC");
            $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table} ORDER BY `date` DESC");
            $stmt->execute();

            return $stmt->fetchAll();
        }

    }

    /**
     * :: ADD NEW PRODUCT
     */

    public function mdlAddProduct($table, $data) {
        $stmt = Connection::connect()->prepare("INSERT INTO {$table} (category_id, code, description, stock, buying_price, selling_price, image) 
                VALUES (:category_id, :code, :description, :stock, :buying_price, :selling_price, :image)");
        $stmt->bindParam(":category_id", $data["category_id"]);
        $stmt->bindParam(":code", $data["code"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":stock", $data["stock"]);
        $stmt->bindParam(":buying_price", $data["buying_price"]);
        $stmt->bindParam(":selling_price", $data["selling_price"]);
        $stmt->bindParam(":image", $data["image"]);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /**
     * :: EDIT EXISTING PRODUCT
     */

    public function mdlEditProduct($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} SET category_id = :category_id, code = :code, description=:description, stock=:stock,
        buying_price = :buying_price, selling_price = :selling_price, image = :image WHERE code = :code");
        $stmt->bindParam(":category_id", $data["category_id"]);
        $stmt->bindParam(":code", $data["code"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":stock", $data["stock"]);
        $stmt->bindParam(":buying_price", $data["buying_price"]);
        $stmt->bindParam(":selling_price", $data["selling_price"]);
        $stmt->bindParam(":image", $data["image"]);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /**
     * :: DELETE EXISTING PRODUCT
     */
    public function mdlDeleteProduct($table, $data) {
        $stmt = Connection::connect()->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /**
     * :: UPDATE EXISTING PRODUCTS
     */

    static public function mdlUpdateProduct($table, $item1, $value1, $_value) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} SET $item1 = :$item1 WHERE id = :id");
        $stmt ->bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt ->bindParam(":id", $_value, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


    /**
     * :: SHOW SALES SUM
     */

    public function mdlShowSalesSum($table) {

    $stmt = Connection::connect()->prepare("SELECT SUM(sales) as total FROM {$table}");
    $stmt->execute();
    return $stmt->fetch();

    }




}
