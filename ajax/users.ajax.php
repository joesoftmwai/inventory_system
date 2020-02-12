<?php

require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";


class AjaxUsers
{
    /**
     * :: EDIT USERS
     */
    public $userId;

    public function ajaxEditUsers()
    {

        $item = "id";
        $value = $this->userId;
        $response = UserController::ctrShowUsers($item, $value);

        echo json_encode($response);


    }

    /**
     *:: ACTIVATE USER
     */

    public $activateId;
    public $activateUser;

    public function ajaxActivateUser() {
        $table="test";
        $item1 = "status";
        $value1 = $this->activateUser;
        $item2 = "id";
        $value2 = $this->activateId;

        $response = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);
    }

    /**
     *:: VALIDATE USER
     */
    public $validateUser;
    public function ajaxValidateUser() {

        $item = "username";
        $value = $this->validateUser;
        $response = UserController::ctrShowUsers($item, $value);

        echo json_encode($response);


    }


}

/**
 *:: EDIT USER
 */

if (isset($_POST['userId'])) {
    $edit = new AjaxUsers();
    $edit->userId = $_POST['userId'];
    $edit->ajaxEditUsers();

}

/**
 *:: ACTIVATE USER
 */

if (isset($_POST['activateUser'])) {
    $activateUser = new AjaxUsers();
    $activateUser -> activateId = $_POST['activateId'];
    $activateUser -> activateUser = $_POST['activateUser'];
    $activateUser->ajaxActivateUser();
}

/**
 *:: VALIDATE USER
 */

if (isset($_POST["validateUser"]))  {
    $validateUser = new AjaxUsers();
    $validateUser->validateUser = $_POST['validateUser'];
    $validateUser->ajaxValidateUser();
}














