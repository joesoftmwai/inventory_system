<?php

require_once "connection.php";

class CategoryModel
{
    public function mdlCreateCategory($table, $data) {
        $stmt = Connection::connect()->prepare("INSERT INTO {$table} (name) VALUES (:data)");
        $stmt->bindParam(":data", $data, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public function mdlShowCategories($table, $item, $value) {

        if($item != null) {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table} WHERE $item = :$item");
            $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM {$table}");
            $stmt -> execute();
            return $stmt->fetchAll();
        }
    }

    /**
     * :: EDIT CATEGORY
     */

    public function mdlEditCategory($table, $data) {
        $stmt = Connection::connect()->prepare("UPDATE {$table} set name = :name WHERE id = :id"); // name represents category name
        $stmt->bindParam(":name", $data["category"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


    /**
     * :: DELETE CATEGORY
     */

    public function mdlDeleteCategory($table, $data) {
        $stmt = Connection::connect()->prepare("DELETE FROM {$table} WHERE id = :id");
        $stmt->bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


}
