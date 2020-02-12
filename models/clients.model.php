<?php

require_once 'connection.php';

class ClientModel
{

    public function mdlCreateClient($table, $data) {

        $stmt = Connection::connect()->prepare("INSERT INTO {$table} (name, document_id, email, phone, address, date_of_birth) 
                VALUES (:name, :document_id, :email, :phone, :address, :date_of_birth)");
        $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(":document_id", $data['document_id'], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data['phone'], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data['address'], PDO::PARAM_STR);
        $stmt->bindParam(":date_of_birth", $data['date_of_birth'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

    }

    /**
     * :: SHOW/ VIEW CLIENT(s)
     */

    public function mdlShowClients($table, $item, $value) {

        if ($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE {$item} = :$item");
            $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();

        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table}");
            $stmt->execute();

            return $stmt->fetchAll();
        }

    }


    /**
     * ::EDIT CLIENT
     */

    public function mdlEditClient($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} SET name = :name, document_id = :document_id, 
                email = :email, phone = :phone, address = :address, date_of_birth = :date_of_birth WHERE id = :id");
        $stmt->bindParam(":id", $data['id'], PDO::PARAM_INT);
        $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(":document_id", $data['document_id'], PDO::PARAM_INT);
        $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data['phone'], PDO::PARAM_STR);
        $stmt->bindParam(":address", $data['address'], PDO::PARAM_STR);
        $stmt->bindParam(":date_of_birth", $data['date_of_birth'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /**
     * :: DELETE CLIENT
     */

    public function mdlDeleteClient($table, $data) {
        $stmt =  Connection::connect()->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


    /**
     * ::UPDATE CLIENT
     */

    static public function mdlUpdateClient($table, $item1, $value1, $_value) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} SET $item1 = :$item1 WHERE id = :id");
        $stmt ->bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt ->bindParam(":id", $_value, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }





}
