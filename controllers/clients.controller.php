<?php

class ClientController
{
    /**
     * :: Create Client
     */
    public function ctrCreateClient() {

        if (isset($_POST['add_client'])) {

            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['name'])
                && preg_match('/^[0-9 ]+$/', $_POST['document_id'])
                && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
                && preg_match('/^[()\-0-9 ]+$/', $_POST['phone'])
                && preg_match('/^[-a-zA-Z0-9*@#_! ]+$/', $_POST['address'])) {

                $table = 'clients';

                $data = array(
                    "name" => $_POST['name'],
                    "document_id" => $_POST['document_id'],
                    "email" => $_POST['email'],
                    "phone" => $_POST['phone'],
                    "address" => $_POST['address'],
                    "date_of_birth" => $_POST['date_of_birth']);

                $response = ClientModel::mdlCreateClient($table, $data);

                if ($response == "ok") {
                    echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Client added successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'clients'
                           }
                        });

                </script>";
                }

            } else {
                echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Client cannot be empty or use specific characters',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'clients'
                           }
                        });

                </script>";
            }
        }
    }


    /**
     * :: SHOW CLIENTS
     */
    public function ctrShowClients($item, $value) {

        $table = 'clients';

        $response = ClientModel::mdlShowClients($table, $item, $value);

        return $response;
    }


    /**
     * :: EDIT CLIENT
     */

    public function ctrEditClient() {

        if (isset($_POST['edit_client'])) {

            if (preg_match('/^[a-zA-Z0-9*@#_! ]+$/', $_POST['e_name'])
                && preg_match('/^[0-9 ]+$/', $_POST['e_document_id'])
                && filter_var($_POST['e_email'], FILTER_VALIDATE_EMAIL)
                && preg_match('/^[()\-0-9 ]+$/', $_POST['e_phone'])
                && preg_match('/^[-a-zA-Z0-9*@#_! ]+$/', $_POST['e_address'])) {

                $table = 'clients';

                $data = array(
                    "id" => $_POST['clientId'],
                    "name" => $_POST['e_name'],
                    "document_id" => $_POST['e_document_id'],
                    "email" => $_POST['e_email'],
                    "phone" => $_POST['e_phone'],
                    "address" => $_POST['e_address'],
                    "date_of_birth" => $_POST['e_date_of_birth']);


                $response = ClientModel::mdlEditClient($table, $data);

                if ($response == "ok") {
                    echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Client altered successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'clients'
                           }
                        });

                </script>";
                }

            } else {
                echo "<script>
                    Swal.fire({
                        type: 'error',
                        title: 'Client cannot be empty or use specific characters',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'clients'
                           }
                        });

                </script>";
            }
        }
    }

    /**
     * :: DELETE CLIENT
     */

    public function ctrDeleteClient() {
        if (isset($_GET['clientId'])) {
            $table = 'clients';
            $data = $_GET['clientId'];

            $response = ClientModel::mdlDeleteClient($table, $data);

            if ($response == "ok") {
                echo "<script>
                    Swal.fire({
                        type: 'success',
                        title: 'Client deleted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        closeOnConfirm: false
                        }).then((result) => {
                           if (result.value) {
                               window.location = 'clients'
                           }
                        });

                </script>";
            }
        }
    }






}

