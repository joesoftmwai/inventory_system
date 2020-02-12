<?php

require_once "connection.php";

class UserModel
{
    // view users
    static public function mdlShowUsers($table, $item, $value)
    {
        if ($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt->execute();
            return $stmt->fetchAll();
        }

    }

    // add new users
    static public function mdlCreateUser($table, $data)
    {
        $stmt = Connection::connect()->prepare("INSERT INTO $table (name, username, password, profile, picture, status) 
                VALUES (:name, :username, :password, :profile, :picture, :status)");
        $stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":profile", $data["profile"], PDO::PARAM_STR);
        $stmt->bindParam(":picture", $data["picture"], PDO::PARAM_STR);
        $stmt->bindParam(":status", $data["status"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

    }

    // edit users
    static public function mdlEditUser($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} SET name = :name, username = :username, 
                password = :password, profile = :profile, picture = :picture WHERE username = :username");
        $stmt -> bindParam(":name", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
        $stmt->bindParam(":profile", $data["profile"], PDO::PARAM_STR);
        $stmt->bindParam(":picture", $data["picture"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

    }

    /**
     * @param $table
     * @param $item1
     * @param $value1
     * @param $item2
     * @param $value2
     * @return string
     * :: UPDATE USERS
     */
    static public function mdlUpdateUser($table, $item1, $value1, $item2, $value2) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} SET $item1 = :$item1 WHERE $item2 = :$item2");
        $stmt ->bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt ->bindParam(":".$item2, $value2, PDO::PARAM_INT);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /**
     * :: DELETE USERS
     */

    public function mdlDeleteUser($table, $data) {
        $stmt = Connection::connect()->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

    }

}


