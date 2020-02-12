<?php

require_once "../controllers/clients.controller.php";
require_once "../models/clients.model.php";

class AjaxClients
{
    /**
     * :: EDIT CLIENT
     */
    public $clientId;

    public function ajaxEditClient() {

        $item = 'id';
        $value = $this->clientId;

        $response = ClientController::ctrShowClients($item, $value);

        echo json_encode($response);

    }


}

/**
 * :: EDIT CLIENT.exec
 */

if (isset($_POST['clientId'])) {
    $client = new AjaxClients();
    $client->clientId=$_POST['clientId'];
    $client->ajaxEditClient();
}